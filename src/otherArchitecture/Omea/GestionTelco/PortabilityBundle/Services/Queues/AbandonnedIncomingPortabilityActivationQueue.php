<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\DateService;
use Omea\GestionTelco\PortabilityBundle\Services\External\Email\EmailServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\ProvisioningServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningActivationRequest;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class AbandonnedIncomingPortabilityActivationQueue extends AbstractQueue implements QueueInterface
{
    /** @var DateService */
    protected $dates;

    /** @var EmailProxyService */
    protected $email;

    /** @var ProvisioningServiceInterface */
    protected $provisioning;

    /**
     * @param LoggerInterface              $logger
     * @param array                        $config
     * @param MessagingService             $messaging
     * @param Connection                   $mainDb
     * @param DateService                  $dates
     * @param ProvisioningServiceInterface $provisioning
     * @param EmailServiceInterface        $email
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb,
                                DateService $dates,
                                ProvisioningServiceInterface $provisioning,
                                EmailServiceInterface $email)
    {
        parent::__construct($logger, $config, $messaging, $mainDb);
        $this->dates = $dates;
        $this->provisioning = $provisioning;
        $this->email = $email;
    }

    public function prepare($population, $modulo)
    {
        // Check whether the queue can run today
        $today = new \DateTime('now');
        if (!$this->dates->checkOpenDate($today)) {
            throw new \Exception("No portabilities today !");
        }

        $filter='';
        $params = array(date('Y-m-d'));
        // Parallelization
        if ($modulo > 1) {
            $filter = " AND (PI.MSISDN % ?) = ? ";
            $params[] = $modulo;
            $params[] = $population;
        }

        $autoactivatedIneligibilityReturnCodes = implode(', ', $this->config['misc']['autoactivatedIneligibilityReturnCodes']);

        // Let's get all the "cancellation" messages for portabilities that would have happened today (and that we haven't done anything with yet)
        $query = "SELECT
                    PI.ID_OPI,
                    PI.OPERATION,
                    PI.MSISDN,
                    PI.RIO,
                    PI.IDPORTAGE,
                    PI.DATEPORTAGE,
                    PI.TRANCHE,
                    DPI.ID_CLIENT,
                    SN.ICCID,
                    PA.ID_CLIENT AS ABANDON
                FROM {$this->config['main']['tables']['in']} PI
                JOIN DISE_PNM_IN DPI ON DPI.IDPORTAGE = PI.IDPORTAGE
                LEFT JOIN {$this->config['main']['tables']['status']} PAO ON PAO.RIO = PI.RIO
                JOIN TRANSACTION TR ON TR.ID_CLIENT = DPI.ID_CLIENT
                JOIN COMMANDES CMD ON CMD.ID_TRANS = TR.ID_TRANS
                JOIN STOCK_NSCE SN ON SN.ID_CMD = CMD.ID_CMD
                LEFT JOIN PNM_ABANDON PA ON PA.ID_CLIENT = DPI.ID_CLIENT
                WHERE
                    PI.RECEPTEUR = 'RR'
                    AND (    PI.OPERATION = 'IND'
                         OR (PI.OPERATION = 'ANR' AND PI.CODERETOUR = '{$this->config['misc']['successReturnCode']}')
                         OR (PI.OPERATION = 'ELI' AND CODERETOUR IN ($autoactivatedIneligibilityReturnCodes)))
                    AND PAO.RIO IS NULL
                    AND SN.ETAT = '0'
                    AND DATEPORTAGE <= ?
                    $filter
                ";

        $this->statement = $this->mainDb->executeQuery($query, $params);
    }

    public function process(array $queueItem)
    {
        // We can only process activations during a precise time interval every day, depending on the TRANCHE value
        if (!$this->dates->checkTranche($queueItem['TRANCHE'], 'in', new \DateTime('now'))) {
            $this->logger->info("Tranche {$queueItem['TRANCHE']} for #{$queueItem['ID_OPI']} for portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']} will be processed at another point");
            return;
        }

        // We're good, let's proceed with the activation (without portability)
        $request = new ProvisioningActivationRequest();
        $request->iccid = $queueItem['ICCID'];
        $request->portabilityFlag = false;

        $this->logger->info("Processing failed portability {$queueItem['OPERATION']} message #{$queueItem['ID_OPI']} for portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']}");
        $this->logger->info("About to have the provisioning activate a line with the parameters $request");
        $result = $this->provisioning->activate($request);
        $this->logger->info("Provisioning response for trying to activate {$queueItem['MSISDN']} : $result");

        if ($result->codeRetour != $this->config['misc']['OK']) {
            $this->email->notifyPortability($queueItem['ID_CLIENT']);
        }

        // If not already done, insert into PNM_ABANDON so that a client record can be created later on
        if (empty($queueItem['ABANDON'])) {
            $abandonRequest = 'INSERT INTO PNM_CLIENT (ID_CLIENT) VALUES (?)';
            $nbAbandon = $this->mainDb->executeUpdate($abandonRequest, $queueItem['ID_CLIENT']);
            $this->logger->info("Client #%s inserted into PNM_ABANDON : %d", $queueItem['ID_CLIENT'], $nbAbandon);
        }
    }
}
