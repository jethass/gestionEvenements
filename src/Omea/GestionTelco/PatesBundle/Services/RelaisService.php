<?php
namespace Omea\GestionTelco\PatesBundle\Services;

use Doctrine\ORM\EntityManager;
use Omea\GestionTelco\PatesBundle\Actions\ActionFactory;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringAction;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringStep;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Psr\Log\LoggerInterface;
use SoapClientBundle\Services\SoapClientService;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RelaisService
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityManager
     */
    private $emMain;

    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * @var array
     */
    private $servicesConfig;

    /**
     * @var array
     */
    private $femtoConfig;

    /**
     * @var SoapClientService
     */
    private $soapClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param SoapClientService $clientService
     * @param array $servicesConfig
     * @param array $femtoConfig
     */
    public function __construct(
        LoggerInterface $logger,
        RegistryInterface $doctrine,
        SoapClientService $clientService,
        array $servicesConfig,
        array $femtoConfig
    ) {
        $this->logger = $logger;
        $this->em = $doctrine->getManager();
        $this->emMain = $doctrine->getManager('main');
        $this->doctrine = $doctrine;
        $this->servicesConfig = $servicesConfig;
        $this->soapClient = $clientService;
        $this->femtoConfig = $femtoConfig;
    }

    /**
     * @param string $provisioning
     * @param integer $limit
     */
    public function provisioning($provisioning, $limit = null)
    {
        if (null === $limit) {
            $limit = 1;
        }

        $this->logger->info(sprintf('Starting provisioning batch for %s with limit %d', $provisioning, $limit));
        $provisioningActions = $this->getProvisioningActions($provisioning);
        
        $queueRequest = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoring')
            ->getQueueProvisioning($provisioningActions, $limit);

        $this->logger->info(sprintf('Processing queue of %d element(s)', count($queueRequest)));
        $this->handleQueue($provisioning, $provisioningActions, $queueRequest);
    }

    /**
     * Handle the queue process
     *
     * @param string $provisioning
     * @param string $provisioningActions
     * @param array $queue
     * @throws \Exception
     */
    private function handleQueue($provisioning, $provisioningActions, $queue)
    {
        // @TODO : laisser nom de la méthode en conf ou mettre en constant dans les actionClass ???
        foreach ($queue as $item) {
            if ($this->checkCallDate($provisioning)) {
                if (!$this->checkLastCallTime($provisioning, $provisioningActions)) {
                    $this->logger->debug(
                        sprintf('------------------ SLEEPING ------------------')
                    );
                    sleep($this->servicesConfig['parameters'][$provisioning]['interval']);
                }

                $this->logger->info(sprintf('Processing item id %d', $item->getFemtoMonId()));

                $actionClass = ActionFactory::get(
                    $item->getTypeAction()->getIntitule(),
                    $this->doctrine,
                    $this->soapClient,
                    $this->femtoConfig,
                    $this->servicesConfig
                );

                // Ugly but no need to call the relais_pates ws for the order...
                if ($provisioning !== 'order') {
                    
                    $method = $this->getRelaisMethodName($item->getTypeAction()->getIntitule());
                    $response = null;

                    // Add an exception handling for specific cases (cf AddMsisdn)
                    try {
                        $request = $actionClass->generateRequest($item);
                    } catch (\Exception $e) {
                        // If an exception is raised, we create a blocking error
                        $request = false;
                        $response = new \stdClass();
                        $response->reasonCode = 'VM003';
                    }

                    // We can't log the IMSI (because of SFR) so remove it if it exists
                    if (isset($request['IMSI'])) {
                        $editedRequest = $request;
                        unset($editedRequest['IMSI']);
                        $this->logger->info(
                            sprintf('Calling ws method %s with request %s', $method, print_r($editedRequest, true))
                        );
                    } else {
                        $this->logger->info(
                            sprintf('Calling ws method %s with request %s', $method, print_r($request, true))
                        );
                    }

                    // Add a test on $request for the AddMsisdn and the RemoveMsisdn checks
                    if (false !== $request) {
                        $this->updateFpm($item, FemtoProvisioningMonitoringStep::CALL_GATEWAY);

                        // Handle a generic error if the relais_pates send a SoapFault
                        try {
                            $response = $this->doCall($provisioning, $method, $request);
                        } catch (\Exception $e) {
                            $response = new \stdClass();
                            $response->reasonCode = 'Client';
                        }

                        // Set the SendAt date
                        $this->updateFpm($item, FemtoProvisioningMonitoringStep::CALL_GATEWAY, null, true);
                    } elseif (null === $response) {
                        // If the response is null, we create a non-blocking error (cf config error_code_to_skip)
                        $response = new \stdClass();
                        $response->reasonCode = 'VM001';
                    }

                    $this->logger->info(sprintf('Ws response %s', print_r($response, true)));
                } else {
                    $this->logger->info(
                        sprintf('Calling method updateTransaction for fpm item %s', $item->getFemtoMonId())
                    );
                    $response = $actionClass->updateTransaction($item);
                    $this->logger->info(
                        sprintf(
                            'UpdateTransaction response for fpm item %s : %s',
                            $item->getFemtoMonId(),
                            print_r($response, true)
                        )
                    );
                }

                // Update the code_retour and date_traitement of the fpm
                if ($response->reasonCode === '0') {
                    // OK
                    $actionClass->callback($item);
                    $this->updateFpm($item, FemtoProvisioningMonitoringStep::END, $response->reasonCode);
                } elseif (in_array($response->reasonCode, $this->servicesConfig['error_code_to_skip'])) {
                    // Leave the current item in pending
                    $this->updateFpm($item, FemtoProvisioningMonitoringStep::PENDING);
                } else {
                    // Error
                    $this->updateFpm($item, FemtoProvisioningMonitoringStep::CALL_GATEWAY, 6000);
                    $actionClass->callbackOnFailure($item);
                }
            }
        }
    }

    /**
     * Handle the call to the ws
     *
     * @param string $provisioning
     * @param string $method
     * @param array $request
     * @return mixed
     * @throws \SoapClientBundle\Exception\SoapClientException
     */
    private function doCall($provisioning, $method, $request)
    {
        $wsConfig = $this->servicesConfig['parameters'][$provisioning]['ws'];
        $this->soapClient->setPathWsdl($wsConfig['wsdl']);
        $this->soapClient->setOptions('location', $wsConfig['location']);
        $this->soapClient->setServiceName($method);

        return $this->soapClient->send(array($request));
    }

    /**
     * Update the given FPM
     *
     * @param FemtoProvisioningMonitoring $fpm
     * @param integer $step
     * @param null $responseCode
     */
    private function updateFpm(FemtoProvisioningMonitoring $fpm, $step, $responseCode = null, $sendAt = null)
    {
        $fpm->setStep(
            $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringStep')->find($step)
        );

        if (null !== $responseCode) {
            $fpm->setCodeRetour($responseCode);
            $fpm->setDateTraitement(new \DateTime());
        }

        if (null !== $sendAt) {
            $fpm->setSendAt(new \DateTime());
        }

        $this->em->flush();
    }

    /**
     * Get the method to call from the config
     *
     * @param string $action
     * @return string
     * @throws NotFoundException
     */
    private function getRelaisMethodName($action)
    {
        if (isset($this->servicesConfig['services'][strtolower($action)]['ws_method'])) {
            return $this->servicesConfig['services'][strtolower($action)]['ws_method'];
        } else {
            throw new NotFoundException(sprintf('Relais Method name for action %s not found', $action));
        }
    }

    /**
     * Check if a new call can be made, based on the last call time and the frequency allowed
     *
     * @param string $provisioning
     * @param string $provisioningActions
     * @return bool
     */
    private function checkLastCallTime($provisioning, $provisioningActions)
    {
        if (null !== $interval = $this->servicesConfig['parameters'][$provisioning]['interval']) {
            $lastCallProvisioning = $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoring')
                ->getLastCallByActions($provisioningActions);

            if (!empty($lastCallProvisioning) && null !== $lastCallProvisioning->getSendAt()) {
                $limitDate = new \DateTime();
                $limitDate->modify('-'.$interval.' seconds');

                $this->logger->debug(
                    sprintf(
                        'CheckLastCallTime > last call : %s | next call : %s',
                        $lastCallProvisioning->getSendAt()->format('d/m/Y H:i:s'),
                        $limitDate->format('d/m/Y H:i:s')
                    )
                );
                if (null !== $lastCallProvisioning && $lastCallProvisioning->getSendAt() >= $limitDate) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param string $provisioning
     * @return bool
     */
    private function checkCallDate($provisioning)
    {
        // If we need to check the date
        if ($this->servicesConfig['use_ws_sfr_time_restriction']) {
            if (null !== $timeStart = $this->servicesConfig['parameters'][$provisioning]['time_start']) {
                $this->logger->debug(
                    sprintf(
                        'CheckCallDate > start call : %s',
                        \DateTime::createFromFormat('H:i:s', $timeStart)->format('d/m/Y H:i:s')
                    )
                );
                if (new \DateTime() < \DateTime::createFromFormat('H:i:s', $timeStart)) {
                    return false;
                }
            }

            if (null !== $timeEnd = $this->servicesConfig['parameters'][$provisioning]['time_end']) {
                $this->logger->debug(
                    sprintf(
                        'CheckCallDate > end call : %s',
                        \DateTime::createFromFormat('H:i:s', $timeEnd)->format('d/m/Y H:i:s')
                    )
                );
                if (new \DateTime() > \DateTime::createFromFormat('H:i:s', $timeEnd)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Transform the config into a list of id actions
     *
     * @param string $provisioning
     * @return array
     */
    private function getProvisioningActions($provisioning)
    {
        $configActions = $this->servicesConfig['parameters'][$provisioning]['actions'];
        $actions = array();

        foreach ($configActions as $action) {
            $const = 'Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringAction::'.$action;
            $actions[] = constant($const);
        }

        return $actions;
    }
}
