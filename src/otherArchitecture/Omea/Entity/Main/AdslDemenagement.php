<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ADSL_DEMENAGEMENT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\AdslDemenagementRepository")
 */
class AdslDemenagement
{

    /**
     *      @ORM\Column(name="ID_ADSL_DEMENAGEMENT", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAdslDemenagement;

    /**
     *      @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     *      @ORM\Column(name="DATE_CREATION", type="datetime")
     */
    private $dateCreation;

    /**
     *      @ORM\Column(name="DATE_PLANIFICATION", type="date")
     */
    private $datePlanification;
    
    /**
     *      @ORM\Column(name="DATE_ANNULATION", type="datetime")
     */
    private $dateAnnulation;
    
    /**
     *      @ORM\Column(name="NDI", type="string")
     */
    private $ndi;
    
    /**
     *      @ORM\Column(name="STATUT", type="string")
     */
    private $statut;
    
    /**
     *      @ORM\Column(name="ID_LIGNE_ADSL_ANCIENNE", type="integer")
     */
    private $idLigneAdslAncienne;
    
    /**
     *      @ORM\Column(name="ID_LIGNE_ADSL_NOUVELLE", type="integer")
     */
    private $idLigneAdslNouvelle;

    /**
     *      @ORM\Column(name="ID_OT_ADSL_RESILIATION", type="integer")
     */
    private $idOtAdslResiliation;
    
    /**
     *      @ORM\Column(name="ID_OT_ADSL_ACTIVATION", type="integer")
     */
    private $idOtAdslActivation;
    
    /**
     *      @ORM\Column(name="ID_ADRESSE_TITULAIRE", type="integer")
     */
    private $idAdresseTitulaire;
    
    /**
     *      @ORM\Column(name="ID_ADRESSE_CLIENT", type="integer")
     */
    private $idAdresseClient;
    
    /**
     *      @ORM\Column(name="ID_FLUIDITE_INTERNET", type="integer")
     */
    private $idFluiditeInternet;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT")
     */
    private $client;
    
    /**
     * @ORM\OneToOne(targetEntity="LigneAdsl")
     * @ORM\JoinColumn(name="ID_LIGNE_ADSL_ANCIENNE", referencedColumnName="ID")
     */
    private $ligneAdslAncienne;
    
    /**
     * @ORM\OneToOne(targetEntity="LigneAdsl")
     * @ORM\JoinColumn(name="ID_LIGNE_ADSL_NOUVELLE", referencedColumnName="ID")
     */
    private $ligneAdslNouvelle;
    
    /**
     * @ORM\OneToOne(targetEntity="OtAdsl")
     * @ORM\JoinColumn(name="ID_OT_ADSL_RESILIATION", referencedColumnName="ID")
     */
    private $otAdslResiliation;
    
    /**
     * @ORM\OneToOne(targetEntity="OtAdsl")
     * @ORM\JoinColumn(name="ID_OT_ADSL_ACTIVATION", referencedColumnName="ID")
     */
    private $otAdslActivation;
    
    /**
     * @ORM\OneToOne(targetEntity="Adresse")
     * @ORM\JoinColumn(name="ID_ADRESSE_TITULAIRE", referencedColumnName="ID")
     */
    private $adresseTitulaire;
    
    /**
     * @ORM\OneToOne(targetEntity="Adresse")
     * @ORM\JoinColumn(name="ID_ADRESSE_CLIENT", referencedColumnName="ID")
     */
    private $adresseClient;
    
    /**
     * @ORM\OneToOne(targetEntity="FluiditeInternet")
     * @ORM\JoinColumn(name="ID_FLUIDITE_INTERNET", referencedColumnName="ID_FLUIDITE_INTERNET")
     */
    private $fluiditeInternet;
    
	/**
     * @return the $idAdresseClient
     */
    public function getIdAdresseClient()
    {
        return $this->idAdresseClient;
    }

	/**
     * @return the $adresseClient
     */
    public function getAdresseClient()
    {
        return $this->adresseClient;
    }

	/**
     * @param field_type $idAdresseClient
     */
    public function setIdAdresseClient($idAdresseClient)
    {
        $this->idAdresseClient = $idAdresseClient;
    }

	/**
     * @param field_type $adresseClient
     */
    public function setAdresseClient($adresseClient)
    {
        $this->adresseClient = $adresseClient;
    }

	/**
     * @return the $ndi
     */
    public function getNdi()
    {
        return $this->ndi;
    }

	/**
     * @return the $idLigneAdslAncienne
     */
    public function getIdLigneAdslAncienne()
    {
        return $this->idLigneAdslAncienne;
    }

	/**
     * @return the $ligneAdslAncienne
     */
    public function getLigneAdslAncienne()
    {
        return $this->ligneAdslAncienne;
    }

	/**
     * @param field_type $ndi
     */
    public function setNdi($ndi)
    {
        $this->ndi = $ndi;
    }

	/**
     * @param field_type $idLigneAdslAncienne
     */
    public function setIdLigneAdslAncienne($idLigneAdslAncienne)
    {
        $this->idLigneAdslAncienne = $idLigneAdslAncienne;
    }

	/**
     * @param field_type $ligneAdslAncienne
     */
    public function setLigneAdslAncienne($ligneAdslAncienne)
    {
        $this->ligneAdslAncienne = $ligneAdslAncienne;
    }

	/**
     * @return the $otAdslResiliation
     */
    public function getOtAdslResiliation()
    {
        return $this->otAdslResiliation;
    }

	/**
     * @param field_type $otAdslResiliation
     */
    public function setOtAdslResiliation($otAdslResiliation)
    {
        $this->otAdslResiliation = $otAdslResiliation;
    }

	/**
     * @return the $client
     */
    public function getClient()
    {
        return $this->client;
    }

	/**
     * @param field_type $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

	/**
     * @return the $idAdslDemenagement
     */
    public function getIdAdslDemenagement()
    {
        return $this->idAdslDemenagement;
    }

	/**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

	/**
     * @return the $dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

	/**
     * @return the $datePlanification
     */
    public function getDatePlanification()
    {
        return $this->datePlanification;
    }

	/**
     * @return the $dateAnnulation
     */
    public function getDateAnnulation()
    {
        return $this->dateAnnulation;
    }

	/**
     * @return the $statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

	/**
     * @return the $idLigneAdslNouvelle
     */
    public function getIdLigneAdslNouvelle()
    {
        return $this->idLigneAdslNouvelle;
    }

	/**
     * @return the $idOtAdslResiliation
     */
    public function getIdOtAdslResiliation()
    {
        return $this->idOtAdslResiliation;
    }

	/**
     * @return the $idOtAdslActivation
     */
    public function getIdOtAdslActivation()
    {
        return $this->idOtAdslActivation;
    }

	/**
     * @return the $idAdresseTitulaire
     */
    public function getIdAdresseTitulaire()
    {
        return $this->idAdresseTitulaire;
    }

	/**
     * @return the $idFluiditeInternet
     */
    public function getIdFluiditeInternet()
    {
        return $this->idFluiditeInternet;
    }

	/**
     * @return the $ligneAdslNouvelle
     */
    public function getLigneAdslNouvelle()
    {
        return $this->ligneAdslNouvelle;
    }
    
	/**
     * @return the $otAdslActivation
     */
    public function getOtAdslActivation()
    {
        return $this->otAdslActivation;
    }

	/**
     * @return the $adresseTitulaire
     */
    public function getAdresseTitulaire()
    {
        return $this->adresseTitulaire;
    }

	/**
     * @return the $fluiditeInternet
     */
    public function getFluiditeInternet()
    {
        return $this->fluiditeInternet;
    }

	/**
     * @param field_type $idAdslDemenagement
     */
    public function setIdAdslDemenagement($idAdslDemenagement)
    {
        $this->idAdslDemenagement = $idAdslDemenagement;
    }

	/**
     * @param field_type $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

	/**
     * @param field_type $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

	/**
     * @param field_type $datePlanification
     */
    public function setDatePlanification($datePlanification)
    {
        $this->datePlanification = $datePlanification;
    }

	/**
     * @param field_type $dateAnnulation
     */
    public function setDateAnnulation($dateAnnulation)
    {
        $this->dateAnnulation = $dateAnnulation;
    }

	/**
     * @param field_type $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

	/**
     * @param field_type $idLigneAdslNouvelle
     */
    public function setIdLigneAdslNouvelle($idLigneAdslNouvelle)
    {
        $this->idLigneAdslNouvelle = $idLigneAdslNouvelle;
    }

	/**
     * @param field_type $idOtAdslResiliation
     */
    public function setIdOtAdslResiliation($idOtAdslResiliation)
    {
        $this->idOtAdslResiliation = $idOtAdslResiliation;
    }

	/**
     * @param field_type $idOtAdslActivation
     */
    public function setIdOtAdslActivation($idOtAdslActivation)
    {
        $this->idOtAdslActivation = $idOtAdslActivation;
    }

	/**
     * @param field_type $idAdresseTitulaire
     */
    public function setIdAdresseTitulaire($idAdresseTitulaire)
    {
        $this->idAdresseTitulaire = $idAdresseTitulaire;
    }

	/**
     * @param field_type $idFluiditeInternet
     */
    public function setIdFluiditeInternet($idFluiditeInternet)
    {
        $this->idFluiditeInternet = $idFluiditeInternet;
    }

	/**
     * @param field_type $ligneAdslNouvelle
     */
    public function setLigneAdslNouvelle($ligneAdslNouvelle)
    {
        $this->ligneAdslNouvelle = $ligneAdslNouvelle;
    }

	/**
     * @param field_type $otAdslActivation
     */
    public function setOtAdslActivation($otAdslActivation)
    {
        $this->otAdslActivation = $otAdslActivation;
    }

	/**
     * @param field_type $adresseTitulaire
     */
    public function setAdresseTitulaire($adresseTitulaire)
    {
        $this->adresseTitulaire = $adresseTitulaire;
    }

	/**
     * @param field_type $fluiditeInternet
     */
    public function setFluiditeInternet($fluiditeInternet)
    {
        $this->fluiditeInternet = $fluiditeInternet;
    }

}
