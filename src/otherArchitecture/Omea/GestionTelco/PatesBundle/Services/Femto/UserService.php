<?php
namespace Omea\GestionTelco\PatesBundle\Services\Femto;

use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClient;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdn;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringAction;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringStep;

use Omea\GestionTelco\PatesBundle\Exception\AccessDeniedException;
use Omea\GestionTelco\PatesBundle\Exception\InvalidArgumentException;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;
use Omea\GestionTelco\PatesBundle\Types\ChangeMsisdnRequest;
use Omea\GestionTelco\PatesBundle\Types\GetAdditionalsListRequest;
use Omea\GestionTelco\PatesBundle\Types\Common\UserType;
use Omea\GestionTelco\PatesBundle\Types\ChangeImsiRequest;
use Omea\GestionTelco\PatesBundle\Types\SetAdditionalsListRequest;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserService extends AbstractService
{
    private $servicesConfig;
    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param array $servicesConfig
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine, array $servicesConfig)
    {
        parent::__construct($logger, $doctrine);
        $this->servicesConfig = $servicesConfig;
    }

    /**
     * @param GetAdditionalsListRequest $request
     * @return array
     */
    public function getAdditionalsList(GetAdditionalsListRequest $request)
    {
        $userList = array();

        //get num_abo from input msisdn
        $numAbo = $this->getNumAboFromMsisdn($request->msisdn);

        //fetch all msisdn for num_abo
        $msisdns = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')->getMsisdnListByNumAbo($numAbo);

        //set response
        if (count($msisdns) > 0) {
            foreach ($msisdns as $current) {
                //exclude handler MSISDN
                if (!in_array($current->getState()->getFmsId(), $this->servicesConfig['valid_state_code'])
                    || $request->msisdn == $current->getMsisdn()
                ) {
                    continue;
                }
                $user = new UserType();
                $user->setMsisdn($current->getMsisdn());
                $user->setImsi($current->getImsi());
                $user->setEtat($current->getState()->getFmsId());
                $userList[] = $user;
            }
        }

        return $userList;
    }
    
    /**
     * @param GetAdditionalsListRequest $request
     * @return string
     */
    public function getFemtoActivationDate(GetAdditionalsListRequest $request)
    {
        $numAbo = $this->getNumAboFromMsisdn($request->msisdn);
        
        $result = '-1';
        
        $validStates = implode(',', array(
            FemtoActiveClientState::COMMANDE,
            FemtoActiveClientState::EN_ATTENTE,
            FemtoActiveClientState::ACTIF,
            FemtoActiveClientState::EN_RESILIATION
        ));
        $femtoActiveClients = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClient')->getClientByNumAboAndState($numAbo, $validStates);
        
        if (null !== ($femtoActiveClient = array_shift($femtoActiveClients))) {
            $result = '';
            if (null !== $femtoActiveClient->getActiveAt()) { 
                $result = $femtoActiveClient->getActiveAt()->format('d/m/Y');
            }
        }
        
        return $result;
    }

    /**
     * @param SetAdditionalsListRequest $request
     * @return boolean
     * @throws NotFoundException
     */
    public function setAdditionalsList(SetAdditionalsListRequest $request)
    {
        $errors = null;
        // Prepare the request parameters to create the complement
        $arguments = (array)$request;
        unset($arguments['msisdn']);

        // Add a new FPM
        $fpm = $this->generateFemtoProvisioningMonitoring(
            FemtoProvisioningMonitoringAction::MANAGE_MSISDN,
            FemtoProvisioningMonitoringStep::START,
            $request->msisdn,
            null,
            $arguments
        );

        $numAbo = $this->getNumAboFromMsisdn($request->msisdn);

        $this->updateFemtoProvisioningMonitoring(
            $fpm,
            FemtoProvisioningMonitoringStep::PENDING,
            $numAbo
        );

        // Get the existant msisdn list
        $existantMsisdnList = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
            ->getMsisdnListByNumAbo($numAbo, FemtoMsisdnState::ACTIF.','.FemtoMsisdnState::EN_ATTENTE);

        $submittedUserList = array_unique($request->userList);

        if (!empty($existantMsisdnList)) {
            // Remove the old Msisdns
            foreach ($existantMsisdnList as $femtoMsisdn) {
                // We only care about the additionnals active msisdn not existant
                if (
                    $femtoMsisdn->getMsisdn() !== $request->msisdn &&
                    !in_array($femtoMsisdn->getMsisdn(), $submittedUserList)
                ) {
                    // Remove the msisdn
                    $removeFpm = $this->generateFemtoProvisioningMonitoring(
                        FemtoProvisioningMonitoringAction::REMOVE_MSISDN,
                        FemtoProvisioningMonitoringStep::PENDING,
                        $femtoMsisdn->getMsisdn(),
                        $numAbo
                    );
                    // Set the state RETRAIT_EN_COURS to the current FemtoMsisdn
                    $femtoMsisdn->setState(
                        $this->em
                            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                            ->find(FemtoMsisdnState::RETRAIT_EN_COURS)
                    );
                } else {
                    // remove the msisdn from the list
                    if (($key = array_search($femtoMsisdn->getMsisdn(), $submittedUserList)) !== false) {
                        unset($submittedUserList[$key]);
                    }
                }
            }
        }

        if (!empty($submittedUserList)) {
            // Add the new Msisdns
            foreach ($submittedUserList as $newMsisdn) {
                try {
                    // Add the new msisdn
                    $this->addMsisdn($newMsisdn, $numAbo);
                } catch (\Exception $e) {
                    $errors[] = $e->getMessage();
                    $this->logger->warning($e->getMessage());
                    continue;
                }
            }
        }

        // Add the dateTraitement manually because there is no cron for this action
        $fpm->setDateTraitement(new \DateTime());
        $this->updateFemtoProvisioningMonitoring(
            $fpm,
            FemtoProvisioningMonitoringStep::END,
            null,
            0
        );

        if (null !== $errors) {
            throw new NotFoundException(implode(' - ', $errors), NotFoundException::NSCE);
        }

        return true;
    }

    /**
     * @param ChangeMsisdnRequest $request
     * @return bool
     * @throws \Exception
     */
    public function changeMsisdn(ChangeMsisdnRequest $request)
    {
        // Prepare the request parameters to create the complement
        $arguments = (array)$request;
        unset($arguments['oldMsisdn']);

        // Add a new FPM
        $fpm = $this->generateFemtoProvisioningMonitoring(
            FemtoProvisioningMonitoringAction::CHANGE_MSISDN,
            FemtoProvisioningMonitoringStep::START,
            $request->oldMsisdn,
            null,
            $arguments
        );

        // Check that the oldMsisdn is in FemtoMsisdn
        $femtoMsisdn = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')->findOneBy(
            array(
                'msisdn' => $request->oldMsisdn,
                'state' => FemtoMsisdnState::ACTIF
            )
        );

        if (!$femtoMsisdn) {
            throw new NotFoundException('Msisdn not found in table FemtoMsisdn', NotFoundException::MSISDN);
        }

        $numAbo = $femtoMsisdn->getFac()->getNumAbo();

        $this->updateFemtoProvisioningMonitoring(
            $fpm,
            FemtoProvisioningMonitoringStep::PENDING,
            $numAbo
        );

        // Check that the NumAbo has the given MSISDN
        $isMainMsisdn = $this->emMain->getRepository('Main:StockMsisdn')->findOneBy(
            array(
                'numAbo' => $numAbo,
                'msisdn' => $request->newMsisdn
            )
        );

        if ($isMainMsisdn) {
            $this->generateFemtoProvisioningMonitoring(
                FemtoProvisioningMonitoringAction::CHANGE_HOST,
                FemtoProvisioningMonitoringStep::PENDING,
                $request->oldMsisdn,
                $numAbo,
                $arguments
            );
        }

        return true;
    }

    /**
     * @param ChangeImsiRequest $request
     * @return bool
     * @throws NotFoundException
     */
    public function changeImsi(ChangeImsiRequest $request)
    {
        // Prepare the request parameters to create the complement
        $arguments = (array)$request;
        unset($arguments['msisdn']);

        // Add a new FPM
        $fpm = $this->generateFemtoProvisioningMonitoring(
            FemtoProvisioningMonitoringAction::CHANGE_IMSI,
            FemtoProvisioningMonitoringStep::START,
            $request->msisdn,
            null,
            $arguments
        );

        // Check that the oldMsisdn is in FemtoMsisdn
        $femtoMsisdn = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')->findOneBy(
            array(
                'msisdn' => $request->msisdn,
                'state' => FemtoMsisdnState::ACTIF
            )
        );

        if (!$femtoMsisdn) {
            throw new NotFoundException('Msisdn not found in table FemtoMsisdn', NotFoundException::MSISDN);
        }

        $numAbo = $femtoMsisdn->getFac()->getNumAbo();

        $this->updateFemtoProvisioningMonitoring(
            $fpm,
            FemtoProvisioningMonitoringStep::PENDING,
            $numAbo
        );

        return true;
    }

    /**
     * @param string $msisdn
     * @param string $numAbo
     * @return bool
     */
    public function addMsisdn($msisdn, $numAbo)
    {
        $fpm = $this->generateFemtoProvisioningMonitoring(
            FemtoProvisioningMonitoringAction::ADD_MSISDN,
            FemtoProvisioningMonitoringStep::PENDING,
            $msisdn,
            $numAbo
        );

        $fac = $this->getActiveClients(
            $numAbo,
            FemtoActiveClientState::COMMANDE.','.FemtoActiveClientState::EN_ATTENTE.','.FemtoActiveClientState::ACTIF
        );

        if (empty($fac)) {
            throw new InvalidArgumentException('The numAbo '.$numAbo.' does not exists');
        }

        // Insert FemtoMsisdn
        $femtoMsisdn = new FemtoMsisdn();
        $femtoMsisdn->setMsisdn($msisdn);
        $femtoMsisdn->setDateDebut(new \DateTime());
        $femtoMsisdn->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                ->find(FemtoMsisdnState::EN_ATTENTE)
        );
        $femtoMsisdn->setFac($fac[0]);
        $this->em->persist($femtoMsisdn);
        $this->em->flush();

        return true;
    }
}
