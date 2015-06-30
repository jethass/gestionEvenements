<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager\Actes;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ConfigurableActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsInterface;

/**
 * Exemple d'acte configurable
 */
class SMSActe implements ActeInterface, ConfigurableActeInterface
{
    
    /**
     * @var array
     */
    private $smsConfig;
    
    /**
     * @var string
     */
    private $wsEnvoiSms;
    
    /**
     * @var string
     */
    private $wsEligibilityPassEurope;
    
    
    private $options;
    
    /**
     * @param array $histoConfig
     * @param string $wsPoseHisto
     * @param ActesManagerService $actesManagerService
     */
    public function __construct(array $smsConfig,$wsEnvoiSms,$wsEligibilityPassEurope,$actesManagerService)
    {
        $this->smsConfig=$smsConfig;
        $this->wsEnvoiSms=$wsEnvoiSms;
        $this->wsEligibilityPassEurope=$wsEligibilityPassEurope;
        $this->actesManagerService = $actesManagerService;
    }
    
    
    public function handle(EvenementInterface $evenement,$id_acte)
    {
        $code=$evenement->getCode();
        
        $msisdn=$evenement->getMsisdn();
        $id_event=$evenement->getIdEvenement();
        $stockMsisdn = $this->actesManagerService->getStockMsisdn($msisdn);
        $id_client=$stockMsisdn->getIdClient();
        $id_template=$this->smsConfig['id_template'];
             
            
        if($code=='Alerte OCR'){
                $result=$this->actesManagerService->doCallWSEligibilityPassEurope($msisdn,$id_event,$id_client,$id_acte);
                if($result){
                    $this->actesManagerService->doCallWSEnvoiSms($msisdn,$id_event,$id_client,$id_template,$id_acte);
                 }
          }else{
            $this->actesManagerService->doCallWSEnvoiSms($msisdn,$id_event,$id_client,$id_template,$id_acte);
        }
         
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