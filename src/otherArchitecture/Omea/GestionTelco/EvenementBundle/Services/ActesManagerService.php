<?php

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
     * Recupere la table StockMsisdn a partir du msisdn
     *  
     * @param string $msisdn
     * @return \Omea\Entity\Main\StockMsisdn
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
    
    /**
     * Permet de traiter les evenements en attente
     */
    public function handleEvenements()
    {
        $nb = ['ok' => 0, 'ko' => 0]; // Le literal c'est la vie
        $evenements = $this->evenementRepository->findBy(array('dateTraitement' => null, 'type' => 'Notification', 'erreur' => 0));
        
        foreach ($evenements as  $evenement) {
            try {
                $this->logger->debug("Debut du traitement de l'evenement ".$evenement->getIdEvenement()." avec le code ".$evenement->getCode()." et le msisdn ".$evenement->getMsisdn());
                
                $stockMsisdn = $this->getStockMsisdn($evenement->getMsisdn());
                
                // Traite l'evenement
                $this->actesManager->handle($evenement, $stockMsisdn->getIdClient());
                
                // Met a jour la table pour ne plus traite l'evenement
                $evenement->setDateTraitement(new \Datetime('now'));
                $this->gestionEvenementsManager->persist($evenement);
                
                $this->gestionEvenementsManager->flush();
                
                $nb['ok']++;
                
                $this->logger->info("L'évènement ".$evenement->getCode()." (id: ".$evenement->getIdEvenement().") a bien été traité.");
            } catch (\Exception $e) {
                
                $acte = $this->actesManager->getFailedActe();
                $trame = $this->actesManager->getActesDefinitions();
                
                // Cree une nouvelle entree dans gestionEvenementErreur pour un prochain rattrapage
                $gestionEvenementErreur = new GestionEvenementErreur();
                $gestionEvenementErreur->setEvenement($evenement);
                $gestionEvenementErreur->setActeKo($acte);
                $gestionEvenementErreur->setDateErreur(new \Datetime('now'));
                $gestionEvenementErreur->setErreurMessage($e->getMessage());
                $gestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_A_TRAITE);
                $gestionEvenementErreur->setTrame($trame);
                $this->gestionEvenementsManager->persist($gestionEvenementErreur);
                
                // Met a jour l'evenement
                $evenement->setErreur(1);
                $evenement->setErreurRaison($this->actesManager->getErreurRaison());
                $this->gestionEvenementsManager->persist($evenement);
                
                $this->gestionEvenementsManager->flush();
                
                $nb['ko']++;

                $this->logger->warning("Erreur lors de la gestion de l'évènement '".$evenement->getCode()."': ".$e->getMessage().'');
            }
        }
        
        return $nb;
    }
    
    /**
     * Permet de rattraper les evenements tombe en erreur
     */
    public function rattrapageEvenements()
    {
        $nb = ['ok' => 0, 'ko' => 0]; // Le literal c'est la mort
        $gestionEvenementsErreur = $this->gestionEvenementErreurRepository->findBy(array('etat' => GestionEvenementErreur::ETAT_A_TRAITE));
        
        foreach ($gestionEvenementsErreur as $gestionEvenementErreur) {
            
            $evenement = $gestionEvenementErreur->getEvenement();
            
            $this->logger->debug("Debut du traitement de l'evenement ".$evenement->getIdEvenement()." avec le code ".$evenement->getCode()." et le msisdn ".$evenement->getMsisdn());
            
            try {
                $stockMsisdn = $this->getStockMsisdn($evenement->getMsisdn());
                $this->actesManager->handle($evenement, $stockMsisdn->getIdClient());
                
                // Met a jour l'evenement original
                $evenement->setDateTraitement(new \Datetime('now'));
                $this->gestionEvenementsManager->persist($evenement);
                
                // Clos l'erreur dans gestionEvenementErreur
                $gestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_TRAITE);
                $this->gestionEvenementsManager->persist($gestionEvenementErreur);
                
                $this->gestionEvenementsManager->flush();
                
                $nb['ok']++;
                
                $this->logger->info("L'évènement ".$evenement->getCode()." (id: ".$evenement->getIdEvenement().") a bien été traité.");
    
            } catch (\Exception $e) {
                
                // Clos l'erreur dans gestionEvenementErreur
                $gestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_ABANDON);
                $acte = $this->actesManager->getFailedActe();
                $trame = $this->actesManager->getActesDefinitions();
                
                // Cree une nouvelle entree dans gestionEvenementErreur pour un prochain rattrapage
                $newGestionEvenementErreur = new GestionEvenementErreur();
                $newGestionEvenementErreur->setEvenement($evenement);
                $newGestionEvenementErreur->setActeKo($acte);
                $newGestionEvenementErreur->setDateErreur(new \Datetime('now'));
                $newGestionEvenementErreur->setErreurMessage($e->getMessage());
                $newGestionEvenementErreur->setEtat(GestionEvenementErreur::ETAT_A_TRAITE);
                $newGestionEvenementErreur->setTrame($trame);
                $this->gestionEvenementsManager->persist($newGestionEvenementErreur);
                $this->gestionEvenementsManager->persist($gestionEvenementErreur);
                
                $this->gestionEvenementsManager->flush();
                
                $nb['ko']++;
    
                $this->logger->warning("Erreur lors de la gestion de l'évènement '".$evenement->getCode()."': ".$e->getMessage().'');
            }
        }
        
        return $nb;
    }
}
