<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager\Actes;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;


class HistoActe  implements ActeInterface
{
    
    /**
     * @var array
     */
    private $histoConfig;
    
    /**
     * @var string
     */
    private $wsPoseHisto;
    

    /*
     *  @var ActesManagerService
     */
    private $actesManagerService;

    /**
     * @param array $histoConfig
     * @param string $wsPoseHisto
     * @param ActesManagerService $actesManagerService
     */
    public function __construct(array $histoConfig,$wsPoseHisto,$actesManagerService)
    {
        $this->histoConfig = $histoConfig;
        $this->wsPoseHisto = $wsPoseHisto;
        $this->actesManagerService = $actesManagerService;
    }


    /**
     * @param EvenementInterface $evenement
     * @param integer $id_acte
     */
    public function handle(EvenementInterface $evenement, $id_acte)
    {
            $id_event=$evenement->getIdEvenement();
            $commMan="";
            $priorite=0;
            $id_conseiller=$this->histoConfig['id_conseiller'];
            $msisdn=$evenement->getMsisdn();
            $stockMsisdn =  $this->actesManagerService->getStockMsisdn($msisdn);
            $id_client=$stockMsisdn->getIdClient();

            $this->actesManagerService->doCallWSPoseHisto($id_client,$id_event,$commMan,$priorite,$id_conseiller,$id_acte);
    }
    
    


}