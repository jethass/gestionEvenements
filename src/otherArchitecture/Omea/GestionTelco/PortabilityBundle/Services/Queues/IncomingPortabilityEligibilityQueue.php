<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\MainRepositoryService;
use Omea\GestionTelco\PortabilityBundle\Services\DateService;
use Omea\GestionTelco\PortabilityBundle\Services\IncomingPortabilityService;
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
     * @param LoggerInterface            $logger
     * @param array                      $config
     * @param MessagingService           $messaging
     * @param MainRepositoryService      $main
     * @param DateService                $dates
     * @param IncomingPortabilityService $creation
     * @param SfrPnmServiceInterface     $sfrPnm
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                MainRepositoryService $main,
                                DateService $dates,
                                IncomingPortabilityService $creation,
                                SfrPnmServiceInterface $sfrPnm)
    {
        parent::__construct($logger, $config, $messaging, $main);
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

        $this->statement = $this->main->executeQuery($query, $params);
    }

    public function process(array $queueItem)
    {
        // Check validity of DATEPORTAGE (if not, reset & abort for now)
        $datePortage = new \DateTime($queueItem['DATEPORTAGE']);
        $dateMin = $this->dates->addOpenDays(new \DateTime('now'), $this->config['misc']['minDaysBeforePortage']);
        if ($datePortage < $dateMin) {
            $ok = $this->main->resetDatePortage($queueItem['ID_PNM_OUT_WAIT']);
            $this->logger->info("Invalid DATEPORTAGE {$queueItem['DATEPORTAGE']} for MSISDN {$queueItem['MSISDN']} - We tried reinitializing it : $ok");
            
            return;
        }

        // SFR tells us which tranches are available
        $availableTranches = $this->sfrPnm->checkAvailability($queueItem['MSISDN'], $queueItem['RIO'], $datePortage, $this->config['operators']['op']);
        if (in_array($queueItem['TRANCHE'], $availableTranches)) {
            // Good news : the requested tranche is available
            $tranche = $queueItem['TRANCHE'];
        } elseif (count($availableTranches) > 0) {
            // Let's use a random available tranche for the same day
            $tranche = $availableTranches[mt_rand(0, count($availableTranches) - 1)];
        } else {
            // No available tranche that day
            $ok = $this->main->resetDatePortage($queueItem['ID_PNM_OUT_WAIT']);
            $this->logger->info("Unavailable DATEPORTAGE {$queueItem['DATEPORTAGE']} for MSISDN {$queueItem['MSISDN']} - We tried reinitializing it : $ok");
            
            return;
        }
        
        // Let's actually reserve the tranche from SFR
        $result = $this->sfrPnm->reservePortability($queueItem['MSISDN'], $queueItem['RIO'], $datePortage, $tranche, $this->config['operators']['op']);
        if (!$result) {
            // No available tranche that day, somehow
            $ok = $this->main->resetDatePortage($queueItem['ID_PNM_OUT_WAIT']);
            $this->logger->info("Unavailable DATEPORTAGE {$queueItem['DATEPORTAGE']} for MSISDN {$queueItem['MSISDN']} - We tried reinitializing it : $ok");
            
            return;
        }

        $this->logger->info("Initializing ELI for client #{$queueItem['ID_CLIENT']}, phone number #{$queueItem['MSISDN']} with date {$queueItem['DATEPORTAGE']}, tranche $tranche");

        // Create the ELI message and initialize some other stuff
        $statusQuery = 'UPDATE PNM_OUT_WAIT SET ACTIV_PNM_V2 = ? WHERE ID_PNM_OUT_WAIT = ?';
        try {
            $this->creation->createIncomingPortability($queueItem['ID_CLIENT'], $queueItem['MSISDN'], $queueItem['RIO'], $queueItem['DATEDEMANDE'], $queueItem['DATEPORTAGE'], $tranche);

            // Update PNM_OUT_WAIT for success
            $this->main->updatePnmOutWait($queueItem['ID_PNM_OUT_WAIT'], '1');

            // TRANSACTION_ETAT
            $this->main->updateTransactionStatus($queueItem['ID_TRANS'], $this->config['misc']['transactionStatus']['awaitingActivation']);
        } catch (\Exception $e) {
            // Update PNM_OUT_WAIT for failure
            $this->main->updatePnmOutWait($queueItem['ID_PNM_OUT_WAIT'], '3');
        }
    }
}
