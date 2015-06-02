<?php
namespace Omea\GestionTelco\EvenementsBundle\Services;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Omea\GestionTelco\EvenementsBundle\Exception\NotFoundException;
use Omea\GestionTelco\EvenementsBundle\Exception\TechnicalException;

class AbstractService
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityManager
     */
    protected $emMain;
    
    

    /**
     * @param LoggerInterface $logger
     * @param RegistryInterface $doctrine
     */
    public function __construct(LoggerInterface $logger, RegistryInterface $doctrine)
    {
        $this->logger = $logger;
        $this->em = $doctrine->getManager();
        $this->emMain = $doctrine->getManager('main');
    }
    
}
