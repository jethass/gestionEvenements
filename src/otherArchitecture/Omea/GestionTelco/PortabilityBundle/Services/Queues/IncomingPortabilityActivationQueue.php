<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\DateService;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\ProvisioningServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningActivationRequest;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class IncomingPortabilityActivationQueue extends AbstractQueue implements QueueInterface
{
    /** @var DateService */
    protected $dates;

    /** @var ProvisioningServiceInterface */
    protected $provisioning;

    /**
     * @param LoggerInterface              $logger
     * @param array                        $config
     * @param MessagingService             $messaging
     * @param Connection                   $mainDb
     * @param DateService                  $dates
     * @param ProvisioningServiceInterface $provisioning
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb,
                                DateService $dates,
                                ProvisioningServiceInterface $provisioning)
    {
        parent::__construct($logger, $config, $messaging, $mainDb);
        $this->dates = $dates;
        $this->provisioning = $provisioning;
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

        // Let's get all the incoming GOP messages planned for today that we haven't done anything for yet
        $query = "SELECT
                    PI.ID_OPI,
                    PI.MSISDN,
                    PI.RIO,
                    PI.IDPORTAGE,
                    PI.DATEPORTAGE,
                    PI.TRANCHE,
                    DPI.ID_CLIENT,
                    SN.ICCID
                FROM {$this->config['main']['tables']['in']} PI
                JOIN DISE_PNM_IN DPI ON DPI.IDPORTAGE = PI.IDPORTAGE
                LEFT JOIN {$this->config['main']['tables']['status']} PAO ON PAO.RIO = PI.RIO
                JOIN TRANSACTION TR ON TR.ID_CLIENT = DPI.ID_CLIENT
                JOIN COMMANDES CMD ON CMD.ID_TRANS = TR.ID_TRANS
                JOIN STOCK_NSCE SN ON SN.ID_CMD = CMD.ID_CMD
                WHERE
                    PI.RECEPTEUR = 'RR'
                    AND PI.OPERATION = 'GOP'
                    AND PAO.NUM_ABO IS NULL
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

        // We're good, let's proceed with the activation
        $request = new ProvisioningActivationRequest();
        $request->iccid = $queueItem['ICCID'];
        $request->portabilityFlag = true;
        $request->msisdn = $queueItem['MSISDN'];
        $request->idPortage = $queueItem['IDPORTAGE'];

        $this->logger->info("Processing message GOP #{$queueItem['ID_OPI']} for portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']}");
        $this->logger->info("About to have the provisioning activate a line with the parameters $request");
        $result = $this->provisioning->activate($request);
        $this->logger->info("Provisioning response for trying to activate {$queueItem['MSISDN']} : $result");
    }
}
