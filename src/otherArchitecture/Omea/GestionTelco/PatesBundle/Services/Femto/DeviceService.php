<?php
namespace Omea\GestionTelco\PatesBundle\Services\Femto;

use Omea\Entity\Main\Transaction;
use Omea\GestionTelco\PatesBundle\Exception\EligibilityException;
use Psr\Log\LoggerInterface;
use SoapClientBundle\Exception\SoapClientException;
use SoapClientBundle\Services\SoapClientService;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClient;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringAction;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringStep;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdn;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;

use Omea\GestionTelco\PatesBundle\Services\Femto\AbstractService;
use Omea\GestionTelco\PatesBundle\Manager\OrderManager;
use Omea\GestionTelco\PatesBundle\Types\CreateOrderRequest;
use Omea\GestionTelco\PatesBundle\Types\ActivateFAPRequest;
use Omea\GestionTelco\PatesBundle\Types\CancellationRequest;
use Omea\GestionTelco\PatesBundle\Types\EligibilityRequest;

use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Omea\GestionTelco\PatesBundle\Exception\AccessDeniedException;
use Omea\GestionTelco\PatesBundle\Exception\TechnicalException;


class DeviceService extends AbstractService
{
    /**
     * @var eligibilityService
     */
    private $eligibilityService;

    /**
     * @var array
     */
    private $orderManagerConfig;

    /**
     * @var OrderManager
     */
    private $orderManager;

    /**
     * @var string
     */
    private $wsGestionLogistiqueUrl;

    /**
     * @var SoapClientService
     */
    private $soapClient;

    /**
     * @var array
     */
    private $femtoConfig;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param EligibilityService $eligibilityService
     * @param OrderManager $orderManager
     * @param array $orderManagerConfig
     * @param SoapClientService $soapClient
     * @param string $wsGestionLogistiqueUrl
     * @param array $femtoConfig
     * @param UserService $userService
     */
    public function __construct(
        LoggerInterface $logger,
        RegistryInterface $doctrine,
        EligibilityService $eligibilityService,
        OrderManager $orderManager,
        array $orderManagerConfig,
        SoapClientService $soapClient,
        $wsGestionLogistiqueUrl,
        $wsGestionComUrl,
        array $femtoConfig,
        UserService $userService
    ) {
        parent::__construct($logger, $doctrine);

        $this->eligibilityService = $eligibilityService;
        $this->orderManager = $orderManager;
        $this->orderManagerConfig = $orderManagerConfig;
        $this->soapClient = $soapClient;
        $this->wsGestionLogistiqueUrl = $wsGestionLogistiqueUrl;
        $this->wsGestionComEmailUrl = $wsGestionComUrl;
        $this->femtoConfig = $femtoConfig;
        $this->userService = $userService;
    }

    /**
     * @param CreateOrderRequest $request
     * @return boolean
     * @throws \Exception
     */
    public function createOrder(CreateOrderRequest $request)
    {
        // Prepare the request parameters to create the complement
        $arguments = (array)$request;
        unset($arguments['msisdn']);

        // Add a new FPM
        $fpm = $this->generateFemtoProvisioningMonitoring(
            FemtoProvisioningMonitoringAction::COMMANDE,
            FemtoProvisioningMonitoringStep::START,
            $request->msisdn,
            null,
            $arguments
        );

        // Try catch to update the fpm in case of error
        try {
            // Check that the msisdn exists
            $msisdn = $this->getStockMsisdn($request->msisdn);

            // Update the FPM with the num abo
            $this->updateFemtoProvisioningMonitoring(
                $fpm,
                FemtoProvisioningMonitoringStep::START,
                $msisdn->getNumAbo()
            );

            // Call eligibility service
            $this->isEligible($msisdn->getMsisdn());

            // Check that the client does not already exist
            $facExists = $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClient')
                ->getClientByNumAboAndState(
                    $msisdn->getNumAbo(),
                    FemtoActiveClientState::COMMANDE.','.
                    FemtoActiveClientState::EN_ATTENTE.','.
                    FemtoActiveClientState::ACTIF
                );

            if (!empty($facExists)) {
                throw new AccessDeniedException(
                    'The client '.$msisdn->getIdClient().' already exists in FemtoActiveClient'
                );
            }

            // Check that the orderManager's config for the given canal exists
            if (!array_key_exists($request->canal, $this->orderManagerConfig)) {
                throw new NotFoundException(
                    sprintf('La configuration pour le canal %s n\'existe pas', $request->canal)
                );
            }

            $orderManagerConfig = $this->orderManagerConfig[$request->canal];

            // Create the order with the orderManager
            $transaction = $this->orderManager->create(
                $msisdn->getIdClient(),
                $orderManagerConfig['idDis'],
                $orderManagerConfig['idMag'],
                $orderManagerConfig['idArt'],
                $orderManagerConfig['transTraite']
            );

            if (!$transaction instanceof Transaction) {
                throw new TechnicalException(
                    'Une erreur est survenue lors de la création de la commande pour le client '.$msisdn->getIdClient()
                );
            }

            // Add the transId to the arguments
            $arguments['transId'] = $transaction->getIdTrans();

            $activeClient = new FemtoActiveClient();
            $activeClient->setNumAbo($msisdn->getNumAbo());
            $activeClient->setState(
                $this->em
                    ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                    ->find(FemtoActiveClientState::COMMANDE)
            );

            $this->em->persist($activeClient);

            $this->updateFemtoProvisioningMonitoring(
                $fpm,
                FemtoProvisioningMonitoringStep::PENDING,
                null,
                0,
                $arguments
            );

            // send email to client
            $this->doCallWSSendEmail($msisdn->getIdClient(), "COMMANDE");

        } catch (\Exception $e) {
            $this->updateFemtoProvisioningMonitoring(
                $fpm,
                FemtoProvisioningMonitoringStep::CHECK_PARAMS,
                null,
                $e->getCode()
            );
            throw $e;
        }

        return true;
    }

    /**
     * @param ActivateFAPRequest $request
     * @return boolean
     * @throws \Exception
     */
    public function activateFAP(ActivateFAPRequest $request)
    {
        $msisdn = $request->msisdn;
        $imei = $request->imei;

        // Prepare the request parameters to create the complement
        $arguments = (array)$request;
        unset($arguments['msisdn']);

        // Add a new FPM
        $fpm = $this->generateFemtoProvisioningMonitoring(
            FemtoProvisioningMonitoringAction::ACTIVATION,
            FemtoProvisioningMonitoringStep::START,
            $msisdn,
            null,
            $arguments
        );

        // Try catch to update the fpm in case of error
        try {
            // Check that the msisdn exists
            $stockMsisdn = $this->getStockMsisdn($msisdn);
            $numAbo = $stockMsisdn->getNumAbo();

            // Check that the imei exists in FEMTO_STOCK
            $femtoStock = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoStock')->find($imei);

            if (empty($femtoStock)) {
                throw new NotFoundException('Le code IMEI ' . $imei . ' n\'existe pas', NotFoundException::IMEI);
            }

            $activeClientsOrder = $this->getActiveClients($numAbo, FemtoActiveClientState::COMMANDE);

            // If there is no line for this activeClient in order state try the other states
            if (empty($activeClientsOrder)) {
                // If we have an active client in the resiliation state
                $activeClientResiliation = $this->getActiveClients($numAbo, FemtoActiveClientState::EN_RESILIATION);
                if (!empty($activeClientResiliation)) {
                    // End the current fpm
                    $this->updateFemtoProvisioningMonitoring(
                        $fpm,
                        FemtoProvisioningMonitoringStep::END,
                        $numAbo
                    );
                    // Call the gestionlogistique ws for option cancellation
                    $this->doCallResiliationOption($stockMsisdn->getClient()->getIdClient());
                    $this->doCallWSSendEmail($stockMsisdn->getIdClient(), "RESILIATION");
                }
                // If we have an active client in the active state
                $activeClientActive = $this->getActiveClients($numAbo, FemtoActiveClientState::ACTIF);
                if (!empty($activeClientActive)) {
                    // Change the Action to 14 (replace box) and the step à 3
                    $fpm->setTypeAction(
                        $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringAction')
                                    ->find(FemtoProvisioningMonitoringAction::REPLACE_BOX)
                    );
                    $this->updateFemtoProvisioningMonitoring(
                        $fpm,
                        FemtoProvisioningMonitoringStep::PENDING,
                        $numAbo
                    );
                    // Call the gestionlogistique ws for option cancellation
                    $this->doCallSAV($stockMsisdn->getClient()->getIdClient());
                    //$this->doCallWSSendEmail($stockMsisdn->getIdClient(), "RESILIATION");
                }

                return true;
            }

            $this->updateFemtoProvisioningMonitoring(
                $fpm,
                FemtoProvisioningMonitoringStep::START,
                $numAbo
            );

            $activeClient = $activeClientsOrder[0];
            $activeClient->setState(
                $this->em
                    ->getRepository('Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState')
                    ->find(FemtoActiveClientState::EN_ATTENTE)
            );
            $activeClient->setImei($femtoStock);

            // Add the msisdn
            $this->userService->addMsisdn($msisdn, $numAbo);

            $this->updateFemtoProvisioningMonitoring(
                $fpm,
                FemtoProvisioningMonitoringStep::PENDING
            );
        } catch (\Exception $e) {
            $this->updateFemtoProvisioningMonitoring(
                $fpm,
                FemtoProvisioningMonitoringStep::CHECK_PARAMS,
                null,
                $e->getCode()
            );
            throw $e;
        }

        return true;
    }


    /**
     * @param CancellationRequest $request
     * @return boolean
     * @throws \Exception
     */
    public function cancellation(CancellationRequest $request)
    {
        $msisdn = $request->msisdn;

        // Add a new FPM
        $fpm = $this->generateFemtoProvisioningMonitoring(
            FemtoProvisioningMonitoringAction::RESILIATION,
            FemtoProvisioningMonitoringStep::START,
            $msisdn
        );

        // Try catch to update the fpm in case of error
        try {
            $stockMsisdn = $this->getStockMsisdn($msisdn);
            $numAbo = $stockMsisdn->getNumAbo();

            $fpm = $this->updateFemtoProvisioningMonitoring($fpm, FemtoProvisioningMonitoringStep::START, $numAbo);

            $activeClientsActive = $this->getActiveClients($numAbo, FemtoActiveClientState::ACTIF);
            // Handle the case of an active FAC
            if (!empty($activeClientsActive)) {
                $activeClient = $activeClientsActive[0];
                $activeClient->setState(
                    $this->em
                        ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                        ->find(FemtoActiveClientState::EN_RESILIATION)
                );

                // Call the gestionlogistique ws for option cancellation
                $this->doCallResiliationOption($stockMsisdn->getClient()->getIdClient());
                $this->doCallWSSendEmail($stockMsisdn->getIdClient(), "RESILIATION");
                $this->updateFemtoProvisioningMonitoring($fpm, FemtoProvisioningMonitoringStep::PENDING);
                return true;
            }

            $activeClientsPending = $this->getActiveClients($numAbo, FemtoActiveClientState::EN_ATTENTE);
            // Handle the case of an pending FAC
            if (!empty($activeClientsPending)) {
                $fpmActivate = $this->em
                    ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoring')
                    ->findOneBy(
                        array(
                            'typeAction' => $this->em
                                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringAction')
                                ->find(FemtoProvisioningMonitoringAction::ACTIVATION),
                            'numAbo'     => $numAbo
                        )
                    );
                $this->updateFemtoProvisioningMonitoring($fpmActivate, FemtoProvisioningMonitoringStep::END);

                $fpmAddMsisdn = $this->em
                    ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoring')
                    ->findOneBy(
                        array(
                            'typeAction' => $this->em
                                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringAction')
                                ->find(FemtoProvisioningMonitoringAction::ADD_MSISDN),
                            'numAbo'     => $numAbo
                        )
                    );
                $this->updateFemtoProvisioningMonitoring($fpmAddMsisdn, FemtoProvisioningMonitoringStep::END);

                $this->updateFemtoProvisioningMonitoring($fpm, FemtoProvisioningMonitoringStep::END);

                $activeClient = $activeClientsPending[0];
                $activeClient->setState(
                    $this->em
                        ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                        ->find(FemtoActiveClientState::RESILIE)
                );

                // Call the gestionlogistique ws for option cancellation
                $this->doCallResiliationOption($stockMsisdn->getClient()->getIdClient());
                $this->doCallWSSendEmail($stockMsisdn->getIdClient(), "RESILIATION");
                return true;
            }

            $activeClientsOrder = $this->getActiveClients($numAbo, FemtoActiveClientState::COMMANDE);
            // Handle the case of an order FAC
            if (!empty($activeClientsOrder)) {
                $fpmOrder = $this->em
                    ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoring')
                    ->findOneBy(
                        array(
                            'typeAction' => $this->em
                                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringAction')
                                ->find(FemtoProvisioningMonitoringAction::COMMANDE),
                            'numAbo'     => $numAbo
                        )
                    );

                if ($fpmOrder->getStep()->getStepId() === FemtoProvisioningMonitoringStep::PENDING) {
                    $this->updateFemtoProvisioningMonitoring($fpmOrder, FemtoProvisioningMonitoringStep::END);
                    $arguments = $this->transformComplementToArray($fpmOrder->getComplement());

                    $transaction = $this->emMain
                        ->getRepository('Omea\Entity\Main\Transaction')
                        ->find($arguments['transId']);

                    $transaction->setTransAnnule(new \DateTime());
                    $this->emMain->flush();

                    $activeClient = $activeClientsOrder[0];
                    $activeClient->setState(
                        $this->em
                            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                            ->find(FemtoActiveClientState::RESILIE)
                    );

                    $this->updateFemtoProvisioningMonitoring($fpm, FemtoProvisioningMonitoringStep::END);
                    return true;
                } elseif ($fpmOrder->getStep()->getStepId() === FemtoProvisioningMonitoringStep::END) {
                    $activeClient = $activeClientsOrder[0];
                    $activeClient->setState(
                        $this->em
                            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                            ->find(FemtoActiveClientState::RESILIE)
                    );

                    $this->updateFemtoProvisioningMonitoring($fpm, FemtoProvisioningMonitoringStep::END);
                    return true;
                }
            }

            // If there was any case throw an exception
            throw new NotFoundException(
                'The numAbo '.$numAbo.' does not exists in FemtoActiveClient',
                NotFoundException::CLIENT_ACTIVE
            );
        } catch (SoapClientException $e) {
            // Catch the SoapClientException to transform it into a TechnicalException (to add the good error code)
            throw new TechnicalException($e->getMessage());
        } catch (\Exception $e) {
            $this->updateFemtoProvisioningMonitoring(
                $fpm,
                FemtoProvisioningMonitoringStep::CHECK_PARAMS,
                null,
                $e->getCode()
            );
            throw $e;
        }
    }

    /**
     * @param $msisdn
     * @return bool
     * @throws EligibilityException
     */
    private function isEligible($msisdn)
    {
        $eligibilityRequest = new EligibilityRequest();
        $eligibilityRequest->msisdn = $msisdn;
        $eligibilityRequest->extendedTest = false;
        $isEligible = $this->eligibilityService->checkEligibility($eligibilityRequest);

        if (!$isEligible) {
            throw new EligibilityException('Le MSISDN n\'est pas éligible');
        }

        return true;
    }

    private function doCallResiliationOption($clientId)
    {
        $this->soapClient->setOptions('uri', $this->wsGestionLogistiqueUrl);
        $this->soapClient->setOptions('location', $this->wsGestionLogistiqueUrl);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsGestionLogistiqueUrl . '/wsdl');
        $this->soapClient->setServiceName('notifierResilierOption');

        $result = $this->soapClient->send(
            array(
                'params' => array(
                    'idClient' => $clientId,
                    'idOption' => $this->femtoConfig['option_id']
                )
            )
        );

        return $result;
    }


    private function doCallSAV($clientId)
    {
        $this->soapClient->setOptions('uri', $this->wsGestionLogistiqueUrl);
        $this->soapClient->setOptions('location', $this->wsGestionLogistiqueUrl);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsGestionLogistiqueUrl . '/wsdl');
        $this->soapClient->setServiceName('notifierSav');

        $result = $this->soapClient->send(
            array(
                'params' => array(
                    'idClient' => $clientId,
                    'idArt' => $this->femtoConfig['id_art']
                )
            )
        );

        return $result;
    }


    private function doCallWSSendEmail($clientId, $step)
    {
        $this->soapClient->setOptions('uri', $this->wsGestionComEmailUrl);
        $this->soapClient->setOptions('location', $this->wsGestionComEmailUrl);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsGestionComEmailUrl . '/wsdl');
        $this->soapClient->setServiceName('notifierFemto');
        try {
            $this->soapClient->send(
                array(
                    'params' => array(
                        'idClient' => $clientId,
                        'idOption' => $this->femtoConfig['option_id'],
                        'idArt' => $this->orderManagerConfig['crm']['idArt'],
                        'step' => $step
                    )
                )
            );
            $this->logger->info('Successfully sent Femto ' . $step . ' email !');
        } catch (\Exception $e) {
            $this->logger->error(
                'Failed to send Femto ' . $step . ' email : ' . $e->getCode() . ' ' . $e->getMessage()
            );
        }

        return true;
    }
}
