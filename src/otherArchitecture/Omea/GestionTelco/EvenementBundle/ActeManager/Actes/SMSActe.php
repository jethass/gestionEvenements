<?php

namespace Omea\GestionTelco\EvenementBundle\ActeManager\Actes;

use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ConfigurableActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\Options\SMSActeOptions;
use Omea\GestionTelco\EvenementBundle\Services\ActesManagerService;
use Omea\GestionTelco\EvenementBundle\Clients\Sms\WsGestionCommunicationSmsService;
use Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierEvenementSms;
use Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\WsGestionClientPassService;
use Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassVerifEligibilitePass;
use Psr\Log\LoggerInterface;

/**
 * Exemple d'acte configurable.
 */
class SMSActe implements ActeInterface, ConfigurableActeInterface
{
    /**
     * @var string
     */
    private $wsEnvoiSms;

    /**
     * @var string
     */
    private $wsEligibilityPassEurope;

    /**
     * @var LoggerInterface
     */
    protected $logger;
    
    
    /**
     * @var SMSActeOptions
     */
    private $options;
    
    

    /**
     * @param string  $wsEnvoiSms
     * @param string  $wsEligibilityPassEurope
     * @param ActesManagerService $actesManagerService
     * @param LoggerInterface   $logger
     */
    public function __construct($wsEnvoiSms, $wsEligibilityPassEurope, LoggerInterface $logger)
    {
        $this->wsEnvoiSms = $wsEnvoiSms;
        $this->wsEligibilityPassEurope = $wsEligibilityPassEurope;
        $this->logger = $logger;
    }

    public function handle(EvenementInterface $evenement, $idClient)
    {
        $code = $evenement->getCode();
        $msisdn = $evenement->getMsisdn();
        $codeTemplate = $this->options->codeTemplate;
        $idOption = $this->options->idOption;
        $idOptionGroup = $this->options->idOptionGroup;

        if ($code == 'Alerte_OCR') {
            $result = $this->doCallWSEligibilityPassEurope($idClient, $idOption, $idOptionGroup, $this->wsEligibilityPassEurope);
            if ($result->codeRetour == 0) {
                $this->doCallWSEnvoiSms($codeTemplate, $idClient, $idOption, $this->wsEnvoiSms);
            }
        } else {
                $this->doCallWSEnvoiSms($codeTemplate, $idClient, $idOption, $this->wsEnvoiSms);

        }
    }

    /**
     * Appel du ws pour tester si le client est eligible au pass dooble trotter
     * 
     * @param integer $id_event
     * @param integer $id_client
     * @param integer $id_option
     * @param integer $id_option_group
     * @param string $wsEligibilityPassEurope
     */
    public function doCallWSEligibilityPassEurope($idClient, $idOption, $idOptionGroup, $wsEligibilityPassEurope)
    {
        $options = array(
            'uri' => $wsEligibilityPassEurope,
            'location' => $wsEligibilityPassEurope,
            'soap_version' => SOAP_1_1
        );
        $wsdl = $wsEligibilityPassEurope.'/wsdl';
        $WsEligibilityService = new WsGestionClientPassService($wsdl, $options);
        $trameClient = new GestionClientPassVerifEligibilitePass();
        $trameClient->setIdClient($idClient);
        $trameClient->setIdOption($idOption);
        $trameClient->setIdOptionGroup($idOptionGroup);
        
        $this->logger->debug('Appel du ws '.$wsEligibilityPassEurope." avec les parametres ".print_r($trameClient, true));
        
        $result = $WsEligibilityService->verifEligibilitePass($trameClient);
        
        $this->logger->debug('Retour du ws '.$wsEligibilityPassEurope." ".print_r($result, true));
        
        return $result;
    }

    /**
     * Appel au ws d'envoi de sms
     * 
     * @param string $code_template
     * @param integer $id_client
     * @param integer $id_event
     * @param integer $id_option
     * @param string $wsEnvoiSms
     */
    public function doCallWSEnvoiSms($codeTemplate, $idClient, $idOption, $wsEnvoiSms)
    {
        $options = array(
            'uri' => $wsEnvoiSms,
            'location' => $wsEnvoiSms,
            'soap_version' => SOAP_1_1
        );
        $wsdl = $wsEnvoiSms.'/wsdl';
        $wsEnvoiSmsService = new WsGestionCommunicationSmsService($wsdl, $options);
        $trameClient = new GestionCommunicationNotifierEvenementSms();
        $trameClient->setCodeTemplate($codeTemplate);
        $trameClient->setIdClient($idClient);
        $trameClient->setIdOption($idOption);
        $wsEnvoiSmsService->notifierEvenementSms($trameClient);
        
        $this->logger->info('Successfully Send SMS Event ');
    }

    public function getOptionsClassname()
    {
        return 'Omea\GestionTelco\EvenementBundle\ActeManager\Actes\Options\SMSActeOptions';
    }

    public function setOptions(ActeOptionsInterface $options)
    {
        $this->options = $options;
    }

    public function validateOptions()
    {
        return array();
    }
}
