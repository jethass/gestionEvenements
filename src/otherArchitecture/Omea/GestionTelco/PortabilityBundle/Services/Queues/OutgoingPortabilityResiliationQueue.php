<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\Queues;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Statement;
use Omea\GestionTelco\PortabilityBundle\Services\MessagingService;
use Omea\GestionTelco\PortabilityBundle\Services\DateService;
use Omea\GestionTelco\PortabilityBundle\Services\External\Billing\BillingServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Services\External\MobileOption\MobileOptionServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\ProvisioningServiceInterface;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningResiliationRequest;
use Omea\GestionTelco\PortabilityBundle\Types\Message;

class OutgoingPortabilityResiliationQueue extends AbstractQueue implements QueueInterface
{
    /** @var DateService */
    protected $dates;

    /** @var BillingServiceInterface */
    protected $billing;

    /** @var ProvisioningServiceInterface */
    protected $provisioning;

    /** @var MobileOptionServiceInterface */
    protected $mobileOption;

    /**
     * @param LoggerInterface              $logger
     * @param array                        $config
     * @param MessagingService             $messaging
     * @param Connection                   $mainDb
     * @param DateService                  $dates
     * @param ProvisioningServiceInterface $provisioning
     * @param BillingServiceInterface      $billing
     * @param MobileOptionServiceInterface $mobileOption
     */
    public function __construct(LoggerInterface $logger,
                                array $config,
                                MessagingService $messaging,
                                Connection $mainDb,
                                DateService $dates,
                                ProvisioningServiceInterface $provisioning,
                                BillingServiceInterface $billing,
                                MobileOptionServiceInterface $mobileOption)
    {
        parent::__construct($logger, $config, $messaging, $mainDb);
        $this->dates = $dates;
        $this->provisioning = $provisioning;
        $this->billing = $billing;
        $this->mobileOption = $mobileOption;
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
        // (and especially not sent an ACQ in response)
        $query = "SELECT
                    PI.ID_OPI,
                    PI.IDPORTAGE,
                    PI.DATEPORTAGE,
                    SM.MSISDN,
                    SM.ID_CLIENT,
                    SM.NUM_ABO,
                    RES.ID_CLIENT AS FLAG_RESI,
                    RES.ID_TRAITEMENTMIC_ZSMART,
                    CL.CYCLE,
                    SN.ID_TE,
                    F.offre_id
                FROM {$this->config['main']['tables']['in']} PI
                JOIN STOCK_MSISDN SM ON SM.MSISDN = PI.MSISDN
                LEFT JOIN STOCK_NSCE SN ON (SN.MSISDN = SM.MSISDN AND SN.ETAT = 1)
                LEFT JOIN {$this->config['main']['tables']['status']} PAO ON (PAO.RIO = PI.RIO AND PAO.NUM_ABO = SM.NUM_ABO)
                LEFT JOIN CLIENT CL ON CL.ID_CLIENT = SM.ID_CLIENT
                LEFT JOIN RESILIATION RES ON RES.ID_CLIENT = SM.ID_CLIENT
                LEFT JOIN FORFAIT F ON F.ID_ART = SM.ID_ART
                LEFT JOIN {$this->config['main']['tables']['out']} PO ON (PO.IDPORTAGE = PI.IDPORTAGE AND PO.OPERATION = 'ACQ')
                WHERE
                    PI.RECEPTEUR = 'DD'
                    AND PI.OPERATION = 'GOP'
                    AND PAO.RIO IS NULL
                    AND PO.IDPORTAGE IS NULL
                    AND PI.DATEPORTAGE <= ?
                    $filter
                ";

        $this->statement = $this->mainDb->executeQuery($query, $params);
    }

    public function process(array $queueItem)
    {
        // We can only process resiliations during a precise time interval every day, depending on the TRANCHE value
        if (!$this->dates->checkTranche($queueItem['TRANCHE'], 'out', new \DateTime('now'))) {
            $this->logger->info("Tranche {$queueItem['TRANCHE']} for #{$queueItem['ID_OPI']} for portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']} will be processed at another point");
            return;
        }

        // We're good, let's proceed with the resiliation
        $request = new ProvisioningResiliationRequest();
        $request->msisdn = $queueItem['MSISDN'];
        $request->portabilityFlag = true;
        $request->idPortage = $queueItem['IDPORTAGE'];

        $this->logger->info("Processing message GOP #{$queueItem['ID_OPI']} for portability #{$queueItem['IDPORTAGE']} of {$queueItem['MSISDN']}");
        $this->logger->info("About to have the provisioning resiliate a line with the parameters $request");
        $result = $this->provisioning->resiliate($request);
        $this->logger->info("Provisioning response for trying to resiliate {$queueItem['MSISDN']} : $result");

        // And now for the annoying part : informing the billing system
        if ($queueItem['ID_TE'] != '2') {
            if (!empty($queueItem['FLAG_RESI'])) {
                $this->clearResiliation($queueItem['ID_CLIENT'], $queueItem['NUM_ABO'], $queueItem['ID_TRAITEMENTMIC_ZSMART']);
            }

            // MANTIS 0022469 : VIP subscriptions get special resiliation types
            if (in_array($queueItem['offre_id'], $this->config['misc']['vipOffers'])) {
                $typeMIC = 2;
                $typeResil = 2;
            } else {
                $typeMIC = 1;
                $typeResil = 1;
            }

            $checkMobileOption = $this->mobileOption->getDetailsClient($queueItem['ID_CLIENT']);

            if ($checkMobileOption['codeRetour'] == 201) {
                // Don't unsubscribe the client from the billing system if he still has a Mobile Option !
                // (We still need him to pay for a few months)
                $idTraitementMic = null;
                $etatResil = '1';
            } else {
                $idTraitementMic = $this->billing->createResiliationMIC($queueItem['ID_CLIENT'], $typeMIC, $queueItem['NUM_ABO'], $queueItem['DATEPORTAGE']);
                $etatResil = '0';
            }

            // Register the resiliation
            $this->setResiliation($queueItem['ID_CLIENT'], $typeResil, $etatResil, $queueItem['DATEPORTAGE'], $idTraitementMic);
        }
    }

    protected function clearResiliation($idClient, $numAbo, $idTraitementMic)
    {
        $deleteQuery = "DELETE FROM RESILIATION WHERE ID_CLIENT = ?";

        $nbLignesDeleted = $this->mainDb->executeUpdate($deleteQuery, array($idClient));
        if ($nbLignesDeleted > 0) {
            $this->billing->createCancellationMIC($idClient, $numAbo, $idTraitementMic);
        }
    }

    protected function setResiliation($idClient, $typeResil, $etatResil, $dateResil, $idTraitementMic = null)
    {
        $insertQuery = "INSERT INTO RESILIATION (ID_CLIENT, TYPE_RESIL, ETAT, PORTABILITE, DATE_RESILIATION, ID_TRAITEMENTMIC_ZSMART) VALUES (?, ?, ?, '0', ?, ?)";
        $values = array($idClient, $typeResil, $etatResil, $dateResil, $idTraitementMic);

        $nbLignesInserted = $this->mainDb->executeUpdate($insertQuery, $values);
        if ($nbLignesInserted != 1) {
            throw new \Exception('Could not create resiliation for client %s', $idClient);
        }
    }
}
