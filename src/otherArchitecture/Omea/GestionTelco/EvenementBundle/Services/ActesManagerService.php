<?php

/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 29/06/15
 * Time: 14:30.
 */
namespace Omea\GestionTelco\EvenementBundle\Services;

use Doctrine\ORM\EntityManager;
use Omea\GestionTelco\EvenementBundle\ActeManager\EvenementRepositoryInterface;
use Omea\GestionTelco\EvenementBundle\ActeManager\GestionEvenementErreurRepositoryInterface;
use Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassGetClientPasses;
use Psr\Log\LoggerInterface;
use Omea\GestionTelco\EvenementBundle\Exception\NotFoundException;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager;
use Omea\Entity\Main\StockMsisdnRepository;
use Omea\Entity\GestionEvenements\EvenementRepository;
use Omea\Entity\GestionEvenements\GestionEvenementErreur;

class ActesManagerService
{
    /**
     * @var LoggerInterface
     */
    protected $logger;


    /**
     * @var EntityManager
     */
    protected $gestionEvenementsManagerManager;

    
    /**
     * @var \Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager
     */
    private $actesManager;


    /**
     * @param LoggerInterface   $logger
     * @param EntityManager $gestionEvenementsManager
     * @param ActesManager $actesManager
     * @param StockMsisdn $stockMsisdnRepository
     * @param Evenement $evenementRepository
     */
    public function __construct(LoggerInterface $logger,
                                EntityManager $gestionEvenementsManager,
                                ActesManager $actesManager,
                                StockMsisdnRepository $stockMsisdnRepository,
                                EvenementRepository $evenementRepository
                                )
    {
        $this->logger = $logger;
        $this->gestionEvenementsManager = $gestionEvenementsManager;
        $this->actesManager = $actesManager;
        $this->stockMsisdnRepository = $stockMsisdnRepository;
        $this->evenementRepository = $evenementRepository;
    }

    /**
     * @param string $msisdn
     *
     * @return \Omea\Entity\Main\StockMsisdn
     *
     * @throws NotFoundException
     */
    public function getStockMsisdn($msisdn)
    {
        $stockMsisdn = $this->stockMsisdnRepository->find($msisdn);
        if (empty($stockMsisdn)) {
            throw new NotFoundException('Le MSISDN '.$msisdn.' n\'existe pas', NotFoundException::MSISDN);
        }

        return $stockMsisdn;
    }
    
    public function handleEvenements()
    {

            //$evenements = $this->$er->findBy(array('dateTraitement' => null, 'type' => 'Notification'));
            $evenements = $this->evenementRepository->findBy(array('dateTraitement' => null, 'type' => 'Notification'));
            
            foreach ($evenements as $key => $evenement) {
                try {

                    $stockMsisdn = $this->getStockMsisdn($evenement->getMsisdn());
                    $this->actesManager->handle($evenement, $stockMsisdn->getIdClient());
                    $evenement->setDateTraitement(new \Datetime('now'));
                    $this->gestionEvenementsManager->persist($evenement);

                } catch (Exception $e) {

                    $acte = $this->actesManager->getFailedActe();
                    $trame= $this->actesManager->getActesDefinitions();
                    $gestionEvenementErreur = new GestionEvenementErreur();
                    $gestionEvenementErreur->setEvenement($evenement->getIdEvenement());
                    $gestionEvenementErreur->setActeKo($acte->getIdActe());
                    $gestionEvenementErreur->setDateErreur(new \Datetime('now'));
                    $gestionEvenementErreur->setErreurMessage($e->getMessage());
                    $gestionEvenementErreur->setAbandon(GestionEvenementErreur::ABANDON_NON);
                    $gestionEvenementErreur->setTrame($trame);
                    $this->gestionEvenementsManager->persist($gestionEvenementErreur);

                    $this->logger->error("Erreur lors de la gestion de l'évènement '".$evenement->getCode()."': ".$e->getMessage().'');
                }
                
                $this->gestionEvenementsManager->flush();
            }
    }

}
