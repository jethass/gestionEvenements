<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\DateService;
use Omea\GestionTelco\PortabilityBundle\Services\IncomingPortabilityCreationService;
use Omea\GestionTelco\PortabilityBundle\Services\External\SfrPnm\SfrPnmServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class IncomingPortabilityEligibilityQueue extends AbstractQueue implements QueueInterface
{
    /** @var DateService */
    protected $dates;

    /** @var SfrPnmServiceInterface */
    protected $sfrPnm;

    /** @var IncomingPortabilityCreationService */
    protected $creation;

    /**
     * @param LoggerInterface                    $logger
     * @param array                              $config
     * @param MessagingService                   $messaging
     * @param Connection                         $mainDb
     * @param DateService                        $dates
     * @param IncomingPortabilityCreationService $creation
     * @param SfrPnmServiceInterface             $sfrPnm
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb,
                                DateService $dates,
                                IncomingPortabilityCreationService $creation,
                                SfrPnmServiceInterface $sfrPnm)
    {
        parent::__construct($logger, $config, $messaging, $mainDb);
        $this->dates = $dates;
        $this->creation = $creation;
        $this->sfrPnm = $sfrPnm;
    }

    public function prepare($population, $modulo)
    {
        $filter='';
        $params = array(date('Y-m-d'));

        $params[] = $this->config['networks']['sfr'];
        $params[] = $this->config['networks']['migration'];

        // Parallelization
        if ($modulo > 1) {
            $filter = " AND (PI.MSISDN % ?) = ? ";
            $params[] = $modulo;
            $params[] = $population;
        }

        // Let's get all the portabilities that are yet to be started (but should)
        $query = "SELECT
                POW.ID_PNM_OUT_WAIT,
                POW.ID_CLIENT,
                POW.MSISDN,
                POW.RIO,
                POW.DATEPORTAGE,
                POW.DATEDEMANDE,
                POW.TRANCHE,
                TR.ID_TRANS
            FROM       PNM_OUT_WAIT POW
            INNER JOIN CLIENT       CL    ON POW.ID_CLIENT = CL.ID_CLIENT
            INNER JOIN TRANSACTION  TR    ON CL.ID_CLIENT = TR.ID_CLIENT
            INNER JOIN STOCK_NSCE   SN    ON SN.ID_CMD = POW.ID_CMD_PNM
            LEFT  JOIN COMMANDES    ctemp ON POW.COMMANDE_PROVISOIRE = ctemp.ID_CMD
            LEFT  JOIN TRANSACTION  ttemp ON ctemp.ID_TRANS = ttemp.ID_TRANS
            WHERE POW.DATEDEMANDE <= ?
                AND POW.DATEDEMANDE != '0000-00-00'
                AND POW.ACTIV_PNM_V2 = '0'
                AND POW.RETRACTATION = '0'
                AND POW.SIM_FINALE = '1'
                AND TR.TRANS_ANNULE IS NULL
                AND ttemp.TRANS_ANNULE IS NULL
                AND SN.ID_NETWORK IN (? , ?)
                $filter
            ";

        $this->statement = $this->mainDb->executeQuery($query, $params);
    }

    public function process(array $queueItem)
    {
        // Check validity of DATEPORTAGE (if not, reset & abort for now)
        $datePortage = new \DateTime($queueItem['DATEPORTAGE']);
        $dateMin = $this->dates->addOpenDays(new \DateTime('now'), $this->config['misc']['minDaysBeforePortage']);
        if ($datePortage < $dateMin) {
            $ok = $this->resetDatePortage($queueItem['ID_PNM_OUT_WAIT']);
            $this->logger->info("Invalid DATEPORTAGE {$queueItem['DATEPORTAGE']} for MSISDN {$queueItem['MSISDN']} - We tried reinitializing it : $ok");
            return;
        }

        // SFR tells us which tranches are available
        $opd = substr($queueItem['RIO'], 0, 2);
        $availableTranches = $this->sfrPnm->checkAvailability($queueItem['MSISDN'], $queueItem['RIO'], $datePortage, $this->config['operators']['op'], $opd);
        if (in_array($queueItem['TRANCHE'], $availableTranches)) {
            // Good news : the requested tranche is available
            $tranche = $queueItem['TRANCHE'];
        } elseif (count($availableTranches) > 0) {
            // Let's use the first available tranche for the same day
            $tranche = $availableTranches[0];
        } else {
            // No available tranche that day
            $ok = $this->resetDatePortage($queueItem['ID_PNM_OUT_WAIT']);
            $this->logger->info("Unavailable DATEPORTAGE {$queueItem['DATEPORTAGE']} for MSISDN {$queueItem['MSISDN']} - We tried reinitializing it : $ok");
        }

        $this->logger->info("Initializing ELI for client #{$queueItem['ID_CLIENT']}, phone number #{$queueItem['MSISDN']} with date {$queueItem['DATEPORTAGE']}, tranche $tranche");

        // Create the ELI message and initialize some other stuff
        $statusQuery = 'UPDATE PNM_OUT_WAIT SET ACTIV_PNM_V2 = ? WHERE ID_PNM_OUT_WAIT = ?';
        try {
            $this->creation->createIncomingPortability($queueItem['ID_CLIENT'], $queueItem['MSISDN'], $queueItem['RIO'], $queueItem['DATEDEMANDE'], $queueItem['DATEPORTAGE'], $tranche, $queueItem['ID_TRANS']);

            // Update PNM_OUT_WAIT for success
            $this->mainDb->executeUpdate($statusQuery, array('1', $queueItem['ID_PNM_OUT_WAIT']));
        } catch (\Exception $e) {
            // Update PNM_OUT_WAIT for failure
            $this->mainDb->executeUpdate($statusQuery, array('3', $queueItem['ID_PNM_OUT_WAIT']));
        }
    }

    protected function resetDatePortage($idPnmOutWait)
    {
        $query = 'UPDATE PNM_OUT_WAIT SET DATEDEMANDE = ?, DATEPORTAGE = ? WHERE ID_PNM_OUT_WAIT = ?';
        $nbLignes = $this->mainDb->executeUpdate($query, array('0000-00-00', '0000-00-00', $idPnmOutWait));
        return $nbLignes;
    }
}
