<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager;

use Omea\GestionTelco\EvenementBundle\ActeManager\AbstractActe;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeInterface;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\EvenementInterface;

class HistoActe extends AbstractActe implements ActeInterface 
{
    
    /**
     * @var array
     */
    private $histoConfig;
    
    /**
     * @var string
     */
    private $wsPoseHisto;
    
    
    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param SoapClientService $soapClient
     * @param array $histoConfig
     * @param string $wsPoseHisto
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine,SoapClientService $soapClient,array $histoConfig,$wsPoseHisto)
    {
        parent::__construct($logger, $doctrine,$soapClient);
        $this->histoConfig=$histoConfig;
        $this->wsPoseHisto=$wsPoseHisto;
    }
    
    
    public function handle(EvenementInterface $evenement)
    {
       
        try {
            $id_event=$evenement->getIdEvenement();
            $commMan="";
            $priorite=0;
            $id_conseiller=$this->histoConfig['id_conseiller'];
            $msisdn=$evenement->getMsisdn();
            $stockMsisdn = $this->getStockMsisdn($msisdn);
            $id_client=$stockMsisdn->getIdClient();
            
            $this->doCallWSPoseHisto($id_client,$id_event,$commMan,$priorite,$id_conseiller);
        } catch (\Exception $e) {
            
        }
    }
    
    
    public function doCallWSPoseHisto($id_client,$id_event,$commMan,$priorite,$id_conseiller)
    {
        $this->soapClient->setOptions('uri', $this->wsPoseHisto);
        $this->soapClient->setOptions('location', $this->wsPoseHisto);
        $this->soapClient->setOptions('soap_version', SOAP_1_1);
        $this->soapClient->setPathWsdl($this->wsPoseHisto . '/wsdl');
        $this->soapClient->setServiceName('poseHistoByEvent');
        try {
            $this->soapClient->send(
                array(
                    'params' => array(
                        'idClient' => $id_client,
                        'idEvent' => $id_event,
                        'commMan' => $commMan,
                        'priorite' => $priorite,
                        'idConseiller' => $id_conseiller                        
                    )
                )
            );
            $this->logger->info('Successfully Pose Histo Event ');
        } catch (\Exception $e) {
            $this->logger->error(
                'Failed Pose Histo Event : ' . $e->getCode() . ' ' . $e->getMessage()
            );
            $this->traceActeError($id_event);
        }

        return true;
    }
    
    
    
    public function traceActeError($id_event)
    {
        
    }
}