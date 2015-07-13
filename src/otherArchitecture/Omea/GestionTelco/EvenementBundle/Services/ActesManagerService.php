<?php

/**
 * Created by PhpStorm.
 * User: rserale
 * Date: 29/06/15
 * Time: 14:30.
 */
namespace Omea\GestionTelco\EvenementBundle\Services;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;
use Omea\GestionTelco\EvenementBundle\Exception\NotFoundException;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActesManager;
use Omea\Entity\Main\StockMsisdnRepository;
use Omea\Entity\GestionEvenements\EvenementRepository;
use Omea\Entity\GestionEvenements\GestionEvenementErreur;
use Omea\Entity\GestionEvenements\GestionEvenementErreurRepository;
use \Doctrine\ORM\EntityManagerInterface;

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
     * @param GestionEvenementEvenement $gestionEvenementErreurRepository
     */
    public function __construct(LoggerInterface $logger,
                                EntityManagerInterface $gestionEvenementsManager,
                                ActesManager $actesManager,
                                StockMsisdnRepository $stockMsisdnRepository,
                                EvenementRepository $evenementRepository,
                                GestionEvenementErreurRepository $gestionEvenementErreurRepository
                                )
    {
        $this->logger = $logger;
        $this->gestionEvenementsManager = $gestionEvenementsManager;
        $this->actesManager = $actesManager;
        $this->stockMsisdnRepository = $stockMsisdnRepository;
        $this->evenementRepository = $evenementRepository;
        $this->gestionEvenementErreurRepository = $gestionEvenementErreurRepository;
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
            $evenements = $this->evenementRepository->findBy(array('dateTraitement' => null, 'type' => 'Notification', 'erreur' => 0));
            
            foreach ($evenements as $key => $evenement) {
                try {
                    $stockMsisdn = $this->getStockMsisdn($evenement->getMsisdn());
                    $this->actesManager->handle($evenement, $stockMsisdn->getIdClient());
                    $evenement->setDateTraitement(new \Datetime('now'));
                    $this->gestionEvenementsManager->persist($evenement);
                    $this->logger->info("L'évènement ".$evenement->getCode()." (id: ".$evenement->getIdEvenement().") a bien été traité. ");
                } catch (\LogicException $e) {
                    
                    $acte = $this->actesManager->getFailedActe();
                    $trame= $this->actesManager->getActesDefinitions();
                    $gestionEvenementErreur = new GestionEvenementErreur();
                    $gestionEvenementErreur->setEvenement($evenement);
                    $gestionEvenementErreur->setActeKo($acte);
                    $gestionEvenementErreur->setDateErreur(new \Datetime('now'));
                    $gestionEvenementErreur->setErreurMessage($e->getMessage());
                    $gestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_A_TRAITE);
                    $gestionEvenementErreur->setTrame($trame);
                    $this->gestionEvenementsManager->persist($gestionEvenementErreur);
                    
                    $evenement->setErreur(1);
                    $evenement->setErreurRaison($this->actesManager->getErreurRaison());
                    $this->gestionEvenementsManager->persist($evenement);

                    $this->logger->error("Erreur lors de la gestion de l'évènement '".$evenement->getCode()."': ".$e->getMessage().'');
                }
            }
            $this->gestionEvenementsManager->flush();
    }
    
    public function rattrapageEvenements()
    {
        $gestionEvenementsErreur = $this->gestionEvenementErreurRepository->findBy(array('etat' => GestionEvenementErreur::ETAT_A_TRAITE));
        
        foreach ($gestionEvenementsErreur as $key => $gestionEvenementErreur) {
            try {
                $evenement = $gestionEvenementErreur->getEvenement();
                $stockMsisdn = $this->getStockMsisdn($evenement->getMsisdn());
                $this->actesManager->handle($evenement, $stockMsisdn->getIdClient());
                $evenement->setDateTraitement(new \Datetime('now'));
                $this->evenementRepository->persist($evenement);
                $gestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_TRAITE);
                $this->gestionEvenementsManager->persist($gestionEvenementErreur);
    
            } catch (\LogicException $e) {
                
                $gestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_ABANDON);
                
                $acte = $this->actesManager->getFailedActe();
                $trame = $this->actesManager->getActesDefinitions();
                $newGestionEvenementErreur = new GestionEvenementErreur();
                $newGestionEvenementErreur->setEvenement($evenement);
                $newGestionEvenementErreur->setActeKo($acte);
                $newGestionEvenementErreur->setDateErreur(new \Datetime('now'));
                $newGestionEvenementErreur->setErreurMessage($e->getMessage());
                $newGestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_A_TRAITE);
                $newGestionEvenementErreur->setTrame($trame);
                $this->gestionEvenementsManager->persist($newGestionEvenementErreur);
                $this->gestionEvenementsManager->persist($gestionEvenementErreur);
    
                $this->logger->error("Erreur lors de la gestion de l'évènement '".$evenement->getCode()."': ".$e->getMessage().'');
            }
  
        }
        $this->gestionEvenementsManager->flush();
    }

}
