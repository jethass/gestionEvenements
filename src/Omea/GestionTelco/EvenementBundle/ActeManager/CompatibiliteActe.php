<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager;
use Omea\GestionTelco\EvenementBundle\ActeManager\AbstractActe;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeInterface;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\EvenementInterface;

class CompatibiliteActe extends AbstractActe implements ActeInterface
{
    /**
     * @var string
     */
    private $wsCompatibilite;
    
    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param SoapClientService $soapClient
     * @param string $wsCompatibilite
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine,SoapClientService $soapClient,$wsCompatibilite)
    {
        parent::__construct($logger, $doctrine,$soapClient);
        $this->wsCompatibilite=$wsCompatibilite;
    }
    
    
    public function handle(EvenementInterface $evenement)
    {
        
    }
}