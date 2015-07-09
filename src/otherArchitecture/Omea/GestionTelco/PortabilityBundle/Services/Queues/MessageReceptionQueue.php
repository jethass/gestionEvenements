<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\External\SfrPnm\SfrPnmServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class MessageReceptionQueue extends AbstractQueue implements QueueInterface
{
    /** @var Connection */
    protected $pnmDb;

    /** @var SfrPnmServiceInterface */
    protected $sfrPnm;

    /**
     * @param LoggerInterface        $logger
     * @param array                  $config
     * @param MessagingService       $messaging
     * @param Connection             $mainDb
     * @param Connection             $pnmDb
     * @param SfrPnmServiceInterface $sfrPnm
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb,
                                Connection $pnmDb,
                                SfrPnmServiceInterface $sfrPnm)
    {
        parent::__construct($logger, $config, $messaging, $mainDb);
        $this->pnmDb = $pnmDb;
        $this->sfrPnm = $sfrPnm;
    }

    public function prepare($population, $modulo)
    {
        $params = array($this->config['messages']['states']['pending'],
                        $this->config['messages']['marque_simm']);
        $filter = '';

        // Parallelization
        if ($modulo > 1) {
            $filter = " AND (MSISDN % ?) = ? ";
            $params[] = $modulo;
            $params[] = $population;
        }

        $query = "SELECT ID,
		                ETAT_MESSAGE,
						OPERATION,
						EMETTEUR,
						RECEPTEUR,
					    CAST(MSISDN AS CHAR) AS MSISDN,
						RIO,
						OPR,
						OPRT,
						OPD,
						OPDT,
						OPA,
						OPAT,
						ID_PORTAGE,
						DATE_FORMAT(DATE_DEMANDE,'%Y-%m-%d') as DATE_DEMANDE,
						DATE_FORMAT(DATE_PORTAGE,'%Y-%m-%d') as DATE_PORTAGE,
						TRANCHE,
						OPET,
						CODE_RETOUR
					FROM ".$this->config['messages']['tables']['in']."
					WHERE ETAT_MESSAGE = ? AND MARQUE_ID = ?
					$filter
					ORDER BY ID ASC";

        $this->statement = $this->pnmDb->executeQuery($query, $params);
    }

    public function process(array $queueItem)
    {
        $this->logger->info("Processing incoming message #{$queueItem['ID']} : {$queueItem['OPERATION']} for portage #{$queueItem['ID_PORTAGE']} of {$queueItem['MSISDN']} ");
        $checkDuplicatesQuery = "SELECT ID_OPI FROM {$this->config['main']['tables']['in']} WHERE OPERATION = ? AND IDPORTAGE = ? LIMIT 1";
        $duplicates = $this->mainDb->fetchAssoc($checkDuplicatesQuery, array($queueItem['OPERATION'], $queueItem['ID_PORTAGE']));
        if ($duplicates != null) {
            // If a similar message already exists in the destination table, we don't try again
            // But we do mark the queued message as "done"
            $this->logger->info("Message #{$queueItem['ID']} is a duplicate of another {$queueItem['OPERATION']} message for {$queueItem['ID_PORTAGE']}");
            $this->messaging->updateState($this->config['messages']['tables']['in'], $queueItem['ID'], $this->config['messages']['states']['done']);
        } else {
            $message = new Message($queueItem);
            $message->state = $this->config['main']['states']['in']['pending'];

            $messageId = $this->messaging->addMessage($this->config['main']['tables']['in'], $message);

            // Mark the original message as "done"
            $this->messaging->updateState($this->config['messages']['tables']['in'], $queueItem['ID'], $this->config['messages']['states']['done']);

            // If this is an incoming portability, let's do some basic processing
            if ($message->recepteur = 'RR') {

                // Update PNM_ACTIVATION_OMG, tracking the last received message
                $paoUpdateQuery = "UPDATE {$this->config['main']['tables']['status']} SET LAST_OPERATION_IN = ?, LAST_CODERETOUR_IN = ?, LAST_DATE_IN = NOW() WHERE MSISDN_PORTE = ? AND IDPORTAGE = ?";
                $nbLines = $this->mainDb->executeUpdate($paoUpdateQuery, array($message->operation, $message->codeRetour, $message->msisdn, $message->idPortage));

                if ($nbLines < 1) {
                    throw new \Exception("No known incoming portability with idPortage {$message->idPortage} for msisdn {$message->msisdn}");
                }

                // Specific actions for some messages :
                switch ($message->operation) {
                    // The portability was accepted by the EGP, let's notify SFR
                    case 'ELI':
                        if ($message->codeRetour == $this->config['misc']['successReturnCode']) {
                            $this->validatePortability($message);
                        }
                        $this->messaging->updateState($this->config['main']['tables']['in'], $messageId, $this->config['main']['states']['in']['done']);
                        break;
                    // The portability was cancelled, let's notify SFR
                    case 'ANR':
                        if ($message->codeRetour != $this->config['misc']['successReturnCode']) {
                            break;
                        }
                        $this->cancelPortability($message);
                        $this->messaging->updateState($this->config['main']['tables']['in'], $messageId, $this->config['main']['states']['in']['done']);
                        break;
                    case 'IND':
                        $this->cancelPortability($message);
                        $this->messaging->updateState($this->config['main']['tables']['in'], $messageId, $this->config['main']['states']['in']['done']);
                        break;
                }
            }
        }
    }

    protected function validatePortability(Message $message)
    {
        $result = $this->sfrPnm->reservePortability($message->msisdn, $message->rio, $message->datePortage, $message->tranche, $message->opr);

        if (!$result) {
            // @TODO : How do we handle SFR denying us the portability ? Cancel ? Reschedule ?
        }
    }

    protected function cancelPortability(Message $message)
    {
        $result = $this->sfrPnm->cancelPortability($message->msisdn, $message->rio, $message->datePortage, $message->tranche, $message->codeRetour, $message->opr);

        if (!$result) {
            throw new \Exception("SFR could not cancel the portability #{$message->idPortage} for {$message->msisdn}");
        }
    }
}
