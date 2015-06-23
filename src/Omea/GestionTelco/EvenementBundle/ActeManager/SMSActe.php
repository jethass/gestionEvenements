<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager;
use Omea\GestionTelco\EvenementBundle\ActeManager\AbstractActe;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ConfigurableActeInterface;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeOptionsInterface;

/**
 * Exemple d'acte configurable
 */
class SMSActe extends AbstractActe implements ActeInterface, ConfigurableActeInterface
{
    
    /**
     * @var array
     */
    private $smsConfig;
    
    /**
     * @var string
     */
    private $wsEnvoiSms;
    
    
    private $options;
    
    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param SoapClientService $soapClient
     * @param array $histoConfig
     * @param string $wsPoseHisto
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine,SoapClientService $soapClient,array $smsConfig,$wsEnvoiSms)
    {
        parent::__construct($logger, $doctrine,$soapClient);
        $this->smsConfig=$smsConfig;
        $this->wsEnvoiSms=$wsEnvoiSms;
    }
    
    
    public function handle(EvenementInterface $evenement)
    {
         try {
             $msisdn=$evenement->getMsisdn();
             $id_event=$evenement->getIdEvenement();
             $stockMsisdn = $this->getStockMsisdn($msisdn);
             $id_client=$stockMsisdn->getIdClient();
             $id_template=$this->smsConfig['id_template'];
             
             $this->doCallWSEnvoiSms($msisdn,$id_event,$id_client,$id_template);
             
        } catch (\Exception $e) {

        }
    }
    
    public function doCallWSEnvoiSms($msisdn,$id_event,$id_client,$id_template)
    {
        $this->soapClient->setOptions('uri', $this->wsEnvoiSms);
        $this->soapClient->setOptions('location', $this->wsEnvoiSms);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsEnvoiSms . '/wsdl');
        $this->soapClient->setServiceName('sendSmsEvent');
        try {
            $this->soapClient->send(
                array(
                    'params' => array(
                        'msisdn' => $msisdn,
                        'idEvent' => $id_event,
                        'idClient' => $id_client,
                        'idTemplate' => $id_template
                    )
                )
            );
            $this->logger->info('Successfully Send SMS Event ');
        } catch (\Exception $e) {
            $this->logger->error(
                'Failed Send SMS Event : ' . $e->getCode() . ' ' . $e->getMessage()
            );
            $this->traceActeError($id_event);
        }
        return true;
    }
    
    
    public function traceActeError($id_event)
    {
        
    }
    
    

    public function getOptionsClassname()
    {
        return 'SMSActeOptions';
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