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
        $code_template = $this->options->codeTemplate;
        $idOption = $this->options->idOption;
        $idOptionGroup=$this->options->idOptionGroup;

        if ($code == 'Alerte_OCR') {
            $result = $this->doCallWSEligibilityPassEurope($id_event,$idClient,$id_option,$idOptionGroup,$id_acte, $this->wsEligibilityPassEurope);
            if ($result) {
                $this->doCallWSEnvoiSms($code_template,$idClient,$id_event,$idOption,$id_acte,$this->wsEnvoiSms);
            }
        } else {
                $this->doCallWSEnvoiSms($code_template,$idClient,$id_event,$idOption,$id_acte,$this->wsEnvoiSms);

        }
    }
    
    public function doCallWSEligibilityPassEurope($id_event,$id_client,$id_option,$id_option_group,$id_acte, $wsEligibilityPassEurope)
    {
        $options = array(
            'uri' => $wsEligibilityPassEurope,
            'location' => $wsEligibilityPassEurope,
            'soap_version' => SOAP_1_1
        );
        $wsdl=$wsEligibilityPassEurope.'/wsdl';
        $WsEligibilityService = new WsGestionClientPassService($wsdl, $options);
        $trameClient = new GestionClientPassVerifEligibilitePass();
        $trameClient->setIdClient($id_client);
        $trameClient->setIdOption($id_option);
        $trameClient->setIdOptionGroup($id_option_group);
        $WsEligibilityService->verifEligibilitePass($trameClient);
        $this->logger->info('Eligible To Pass Europe ');
    }

    public function doCallWSEnvoiSms($code_template,$id_client,$id_event,$id_option,$id_acte,$wsEnvoiSms)
    {
        $options = array(
            'uri' => $wsEnvoiSms,
            'location' => $wsEnvoiSms,
            'soap_version' => SOAP_1_1
        );
        $wsdl=$wsEnvoiSms.'/wsdl';
        $wsEnvoiSmsService = new WsGestionCommunicationSmsService($wsdl, $options);
        $trameClient = new GestionCommunicationNotifierEvenementSms();
        $trameClient->setCodeTemplate($code_template);
        $trameClient->setIdClient($id_client);
        $trameClient->setIdEvent($id_event);
        $trameClient->setIdOption($id_option);
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
