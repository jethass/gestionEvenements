<?php

namespace Omea\GestionTelco\EvenementBundle\ActeManager\Actes;

use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\Services\ActesManagerService;
use Psr\Log\LoggerInterface;
use Omea\GestionTelco\EvenementBundle\Clients\Historique\WsPoseHistoService;
use Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoData;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsInterface;

class HistoActe implements ActeInterface
{
    /**
     * @var string
     */
    private $wsPoseHisto;

    /**
     *  @var ActesManagerService
     */
    private $actesManagerService;
    
    /**
     * @var LoggerInterface
     */
    protected $logger;
    
    /**
     * @var array
     */
    private $paramsConfig;

    /**
     * @param string              $wsPoseHisto
     * @param ActesManagerService $actesManagerService
     * @param LoggerInterface     $logger
     * @param array               $paramsConfig
     */
    public function __construct($wsPoseHisto, LoggerInterface $logger, $paramsConfig)
    {
        $this->wsPoseHisto = $wsPoseHisto;
        $this->logger = $logger;
        $this->paramsConfig = $paramsConfig;
    }

    /**
     * @param EvenementInterface $evenement
     * @param int                $id_acte
     */
    public function handle(EvenementInterface $evenement, $idClient)
    {
        $id_event = $evenement->getIdEvenement();
        $commMan = '';
        $priorite = 0;
        $id_conseiller = $this->paramsConfig['id_conseiller'];
        $options = array(
                'uri' => $this->wsPoseHisto,
                'location' => $this->wsPoseHisto,
                'soap_version' => SOAP_1_1
        );
        $wsdl = $this->wsPoseHisto.'/wsdl';
        $WsPoseHistoService = new WsPoseHistoService($options,$wsdl);
        $trameClient = new PoseHistoData();
        $trameClient->setIdClient($idClient);
        $trameClient->setIdEvent($id_event);
        $trameClient->setCommMan($commMan);
        $trameClient->setPriorite($priorite);       
        $trameClient->setIdConseiller($id_conseiller);
        $WsPoseHistoService->poseHistoByEvent($trameClient);
        $this->logger->info('Successfully Pose Histo Event ');
    }
 
}
