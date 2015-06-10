<?php
namespace Omea\GestionTelco\EvenementsBundle\Services;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Omea\GestionTelco\EvenementsBundle\Types\SaveEvenementRequest;
use Omea\GestionTelco\EvenementsBundle\Types\SaveEvenementResponse;

use Omea\GestionTelco\EvenementsBundle\Exception\NotFoundException;
use Omea\GestionTelco\EvenementsBundle\Exception\AccessDeniedException;
use Omea\GestionTelco\EvenementsBundle\Exception\TechnicalException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Omea\GestionTelco\EvenementsBundle\Entity\Evenement;


class SaveEvenementService
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
        //$this->emMain = $doctrine->getManager('main');
    }

    /**
     * 
     *
     * @param SaveEvenementRequest $request
     * @return boolean
     * @throws \Exception
     */
    public function saveEvenement(SaveEvenementRequest $request)
    {
        
        $this->logger->debug('save evenement begin');

        if($request->msisdn && $request->code && $request->type ){
            $evenement= new Evenement();
            $msisdn = $request->msisdn;
            $code = $request->code;
            $type= $request->type;

            $evenement->setMsisdn($msisdn);
            $evenement->setCode($code);
            $evenement->setType($type);
            $evenement->setDateAppel(new \Datetime('now'));
            $evenement->setDateTraitement(Null);
            $evenement->setCodeRetour(null);

            $this->em->persist($evenement);
            $this->em->flush();

            return "Inserted OK";
        }

    }

    
}
