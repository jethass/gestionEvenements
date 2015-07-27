<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\MainRepositoryService;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class MessageEmissionQueue extends AbstractQueue implements QueueInterface
{
    /**
     * @param LoggerInterface       $logger
     * @param array                 $config
     * @param MessagingService      $messaging
     * @param MainRepositoryService $main
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                MainRepositoryService $main)
    {
        parent::__construct($logger, $config, $messaging, $main);
    }

    public function prepare($population, $modulo)
    {
        $params = array($this->config['main']['states']['out']['pending']);
        $filter = '';

        // Parallelization
        if ($modulo > 1) {
            $filter = " AND (MSISDN % ?) = ? ";
            $params[] = $modulo;
            $params[] = $population;
        }

        $query = "SELECT ID_OPO,
		                ETAT,
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
						IDPORTAGE,
						DATE_FORMAT(DATEDEMANDE,'%Y-%m-%d') as DATE_DEMANDE,
						DATE_FORMAT(DATEPORTAGE,'%Y-%m-%d') as DATE_PORTAGE,
						TRANCHE,
						CODERETOUR
					FROM ".$this->config['main']['tables']['out']."
					WHERE ETAT = ?
					$filter
					ORDER BY ID_OPO ASC";

        $this->statement = $this->main->executeQuery($query, $params);
    }

    public function process(array $queueItem)
    {
        $this->logger->info("Processing outgoing message #{$queueItem['ID_OPO']} : {$queueItem['OPERATION']} for portage #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']} ");

        // Let's fix the return code : if it isn't null, it must be 3-char long
        if (strlen($queueItem['CODERETOUR']) > 0 && strlen($queueItem['CODERETOUR']) < 3) {
            $queueItem['CODERETOUR'] = str_pad($queueItem['CODERETOUR'], 3, '0', STR_PAD_LEFT);
        }

        // @TODO : if OPERATION = ELI or ANR, check whether there's already an unresponded one somewhere in the chain ? What the heck is this ?

        $message = new Message($queueItem);
        $message->state = $this->config['messages']['states']['pending'];

        $this->messaging->addMessage($this->config['messages']['tables']['out'], $message);

        $this->messaging->updateState($this->config['main']['tables']['out'], $queueItem['ID_OPO'], $this->config['main']['states']['out']['done']);
    }
}
