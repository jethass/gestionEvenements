<?php

namespace Omea\GestionTelco\EvenementBundle\ActeManager\Actes;

use Omea\GestionTelco\EvenementBundle\ActeManager\ActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\ConfigurableActeInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementInterface;
use Omea\GestionTelco\EvenementBundle\Services\ActesManagerService;
use Omea\GestionTelco\EvenementBundle\ActeManager\Actes\Options\BridageActeOptions;
use Psr\Log\LoggerInterface;
use Omea\GestionTelco\EvenementBundle\Clients\Bridage\WsGestionClientOptionService;
use Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionAddOption;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeOptionsInterface;

class BridageActe implements ActeInterface, ConfigurableActeInterface
{
    /**
     * @var string
     */
    private $wsAddBridage;
     
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
     * @var BridageActeOptions
     */
    private $options;
    
    /**
     * @param string              $wsAddBridage
     * @param ActesManagerService $actesManagerService
     * @param LoggerInterface     $logger
     * @param array               $paramsConfig
     */
    public function __construct($wsAddBridage, LoggerInterface $logger, $paramsConfig)
    {
        $this->wsAddBridage = $wsAddBridage;
        $this->logger = $logger;
        $this->paramsConfig = $paramsConfig;
    }

    public function handle(EvenementInterface $evenement, $idClient)
    {
        $msisdn = $evenement->getMsisdn();
        $idOption = $this->options->idOption;
        $idOptionGroupe = $this->options->idOptionGroupe;
        $idConseiller = $this->paramsConfig['id_conseiller'];
        $raz = $this->paramsConfig['raz'];
        
        $options = array(
                'uri' => $this->wsAddBridage,
                'location' => $this->wsAddBridage,
                'soap_version' => SOAP_1_1
        );
        $wsdl = $this->wsAddBridage.'/wsdl';
        $wsSoapBridage = new WsGestionClientOptionService($wsdl, $options);
        
        $trameClient = new GestionClientOptionAddOption();
        $trameClient->setIdClient($idClient);
        $trameClient->setIdOption($idOption);
        $trameClient->setIdOptionGroup($idOptionGroupe);
        $trameClient->setIdConseiller($idConseiller);
        $trameClient->setIdActivite(1);
        $trameClient->setJusquaRaz($raz);
        
        $this->logger->debug('Appel du ws '.$this->wsAddBridage." avec les parametres ".print_r($trameClient, true));
        
        $retour = $wsSoapBridage->addOption($trameClient);
        
        $this->logger->debug('retour du ws '.$this->wsAddBridage." ".print_r($retour, true));
    }
    
    
    public function getOptionsClassname()
    {
        return 'Omea\GestionTelco\EvenementBundle\ActeManager\Actes\Options\BridageActeOptions';
    }

    public function setOptions(ActeOptionsInterface $options)
    {
        $this->options = $options;
    }

    public function validateOptions()
    {
        return array();
    }
    
    /**
     * Retourne des chatons, on en aura sans doute besoin un jour
     * @return string
     */
    public function getChatons(){
        return 'Chatons';
    }
}
