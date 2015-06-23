<?php
namespace Omea\GestionTelco\EvenementBundle\ActeManager;
use Omea\GestionTelco\EvenementBundle\ActeManager\AbstractActe;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeInterface;
use Omea\GestionTelco\EvenementBundle\EvenementManager\Interfaces\EvenementInterface;


class BridgeActe extends AbstractActe implements ActeInterface
{

    /**
     * @var string
     */
    private $wsBridge;

    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     * @param SoapClientService $soapClient
     * @param string $wsBridge
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine,SoapClientService $soapClient,$wsBridge)
    {
        parent::__construct($logger, $doctrine,$soapClient);
        $this->wsBridge=$wsBridge;
    }
    
    
    public function handle(EvenementInterface $evenement)
    {
        
    }
}