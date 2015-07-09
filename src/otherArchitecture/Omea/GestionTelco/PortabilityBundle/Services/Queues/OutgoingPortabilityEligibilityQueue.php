<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\DateService;
use Omea\GestionTelco\PortabilityBundle\Types\Message;
use Omea\GestionTelco\PortabilityBundle\Exception\EligibilityException;

class OutgoingPortabilityEligibilityQueue extends AbstractQueue implements QueueInterface
{
    /**
     * @param LoggerInterface  $logger
     * @param array            $config
     * @param MessagingService $messaging
     * @param Connection       $mainDb
     * @param DateService      $dates
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb,
                                DateService $dates)
    {
        parent::__construct($logger, $config, $messaging, $mainDb);
        $this->dates = $dates;
    }

    public function prepare($population, $modulo)
    {
        // Check whether the queue can run today
        $today = new \DateTime('now');
        if (!$this->dates->checkOpenDate($today)) {
            throw new \Exception("No portabilities today !");
        }

        $params = array();
        $filter = '';

        // Parallelization
        if ($modulo > 1) {
            $filter = " AND (PI.MSISDN % ?) = ? ";
            $params[] = $modulo;
            $params[] = $population;
        }

        // Let's get all the incoming ELI messages we haven't sent a response for yet (+ some random misc data we should check)
        $query = "SELECT
                    PI.ID_OPI,
                    PI.DATEDEMANDE,
                    PI.MSISDN,
                    PI.RIO,
                    PI.OPR,
                    PI.OPRT,
                    PI.OPD,
                    PI.OPA,
                    PI.OPAT,
                    PI.IDPORTAGE,
                    PI.DATEPORTAGE,
                    PI.TRANCHE,
                    SM.MSISDN AS MSISDN_SM,
                    SM.RIO AS RIO_SM,
                    SMRIO.MSISDN as MSISDN_RIO,
                    SMRIO.RIO AS RIO_RIO,
                    DA.STATUT_ABONNEMENT,
                    RNPI.OPA AS OPA_RNPI,
                    RNPI.OPAT AS OPAT_RNPI,
                    RES.DATE_RESILIATION
                FROM {$this->config['main']['tables']['in']} PI
                LEFT JOIN {$this->config['main']['tables']['out']} PO ON (PI.IDPORTAGE = PO.IDPORTAGE AND PO.OPERATION = 'ELI')
                LEFT JOIN STOCK_MSISDN SM ON SM.MSISDN = PI.MSISDN
                LEFT JOIN DISE_ABONNEMENT DA ON DA.NUM_ABO = SM.NUM_ABO
                LEFT JOIN STOCK_MSISDN SMRIO ON SMRIO.RIO = PI.RIO
                LEFT JOIN REF_NUMEROS_PORTES_IN RNPI ON RNPI.MSISDN = PI.MSISDN
                LEFT JOIN RESILIATION RES ON (RES.ID_CLIENT = SM.ID_CLIENT AND RES.MIGRATION = '0')
                WHERE
                    PI.RECEPTEUR = 'DD'
                    AND PI.OPERATION = 'ELI'
                    AND PO.ID_OPO IS NULL
                $filter
                ";

        $this->statement = $this->mainDb->executeQuery($query, $params);
    }

    public function process(array $queueItem)
    {
        $this->logger->info("Processing incoming ELI message #{$queueItem['ID_OPI']} for portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']} ");

        // We are ALWAYS creating an ELI message in response, so let's start preparing it
        $message = new Message();
        $message->state = $this->config['main']['states']['out']['pending'];
        $message->operation = 'ELI';
        $message->emetteur = 'DD';
        $message->recepteur = 'EG';
        $message->msisdn = $queueItem['MSISDN'];
        $message->rio = $queueItem['RIO'];
        $message->idPortage = $queueItem['IDPORTAGE'];
        $message->opr = $queueItem['OPR'];
        $message->oprt = $queueItem['OPRT'];
        $message->opd = $queueItem['OPD'];
        $message->opdt = $this->config['operators']['optech'];
        $message->opa = empty($queueItem['OPA_RNPI']) ? $this->config['operators']['op'] : $queueItem['OPA_RNPI'];
        $message->opat = empty($queueItem['OPAT_RNPI']) ? $this->config['operators']['optech'] : $queueItem['OPAT_RNPI'];
        $message->dateDemande = $queueItem['DATEDEMANDE'];
        $message->datePortage = $queueItem['DATEPORTAGE'];
        $message->tranche = $queueItem['TRANCHE'];

        // Now we actually start checking the eligibility
        try {
            $datePortage = new \DateTime($queueItem['DATEPORTAGE']);

            // Let's weed out the portabilities scheduled for a forbidden day
            if (!$this->dates->checkOpenDate($datePortage)) {
                throw new EligibilityException("Date {$queueItem['DATEPORTAGE']} for portability is forbidden", 105);
            }

            // Portabilities can't be scheduled more than 59 days after their creation
            $dateDemande = new \DateTime($queueItem['DATEDEMANDE']);
            $dateMax = clone $dateDemande;
            $dateMax->add(new \DateInterval('P59D'));
            if ($datePortage > $dateMax) {
                throw new EligibilityException("Date {$queueItem['DATEPORTAGE']} for portability is too late", 115);
            }

            // The scheduled date must be at least 3 open days after the creation
            $dateMin = $this->dates->addOpenDays($dateDemande, $this->config['misc']['minDaysBeforePortage']);
            if ($datePortage < $dateMin) {
                throw new EligibilityException("Date {$queueItem['DATEPORTAGE']} for portability is too early", 115);
            }

            // Check the tranche is a valid one
            if (!in_array($queueItem['TRANCHE'], array('11', '15', '51', '55'))) {
                throw new EligibilityException("Tranche {$queueItem['TRANCHE']} for portability is invalid", 125);
            }

            // Check the user is actually active ('E' shouldn't be possible at all, but whatever)
            if (in_array($queueItem['STATUT_ABONNEMENT'], array('C', 'R', 'E'))) {
                throw new EligibilityException("User {$queueItem['MSISDN']} is not active", 350);
            }

            // Wait, isn't this guy already leaving us before the scheduled date ?
            if (!empty($queueItem['DATE_RESILISATION'])) {
                $dateResiliation = new \DateTime($queueItem['DATERESILIATION']);
                if ($datePortage > $dateResiliation) {
                    throw new EligibilityException("Date {$queueItem['DATEPORTAGE']} for portability is after resiliation", 135);
                }
            }

            // This RIO authentication code is all wrong
            if (empty($queueItem['RIO_RIO'])) {
                throw new EligibilityException("RIO code unknown", 201);
            }

            // This phone number isn't carried by us
            if (empty($queueItem['MSISDN_SM'])) {
                throw new EligibilityException("MSISDN {$queueItem['MSISDN']} unknown", 202);
            }

            // Nice try, but this is the wrong RIO auth code for this phone number
            if ($queueItem['RIO_SM'] != $queueItem['RIO']) {
                throw new EligibilityException("MSISDN {$queueItem['MSISDN']} does not have this RIO code", 203);
            }

            // We're actually eligible !
            $message->codeRetour = $this->config['misc']['successReturnCode'];
            $this->logger->info("Portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']} is eligible");
        } catch (EligibilityException $e) {
            $message->codeRetour = (string) $e->getCode();
            $this->logger->info("Portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']} is not eligible : ".$e->getMessage());
        }

        // Let's send our answer
        $this->messaging->addMessage($this->config['main']['tables']['out'], $message);

        // And update the state of the original message
        $this->messaging->updateState($this->config['main']['tables']['in'], $queueItem['ID_OPI'], $this->config['main']['states']['in']['done']);
    }
}
