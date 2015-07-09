<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FLUIDITE_INTERNET")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\FluiditeInternetRepository")
 */
class FluiditeInternet
{

    /**
     *      @ORM\Column(name="ID_FLUIDITE_INTERNET", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFluiditeInternet;

    /**
     *      @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     *      @ORM\Column(name="OFFRE_SOURCE", type="string")
     */
    private $offreSource;

    /**
     *      @ORM\Column(name="OFFRE_CIBLE", type="string")
     */
    private $offreCible;

    /**
     *      @ORM\Column(name="DATE_DEMANDE", type="datetime")
     */
    private $dateDemande;


    /**
     *      @ORM\Column(name="DATE_TRAITEMENT", type="datetime")
     */
    private $dateTraitement;

    /**
     * @ORM\Column(name="DATE_RAZ", type="datetime")
     */
    private $dateRaz;

    /**
     *      @ORM\Column(name="DATE_FLUIDITE", type="datetime")
     */
    private $dateFluidite;

    /**
     *      @ORM\Column(name="CANAL", type="string")
     */
    private $canal;

    /**
     *      @ORM\Column(name="ID_ADRESSE", type="integer")
     */
    private $idAdresse;

    /**
     *      @ORM\Column(name="ID_TRANS", type="integer")
     */
    private $idTrans;

    /**
     *      @ORM\Column(name="ID_ACCEPTATION", type="integer")
     */
    private $idAcceptation;

    /**
     *      @ORM\Column(name="ETAT", type="string")
     */
    private $etat;

    /**
     *      @ORM\Column(name="DEMENAGEMENT", type="boolean")
     */
    private $demenagement;

    /**
     * @ORM\OneToMany(targetEntity="FluiditeInternetOptions", mappedBy="fluiditeInternet")
     * @ORM\JoinColumn(name="ID_FLUIDITE_INTERNET", referencedColumnName="ID_FLUIDITE_INTERNET")
     */
    private $fluiditeInternetOptions;

    /**
     * @ORM\OneToMany(targetEntity="FluiditeInternetError", mappedBy="fluiditeInternet")
     * @ORM\JoinColumn(name="ID_FLUIDITE_INTERNET", referencedColumnName="ID_FLUIDITE_INTERNET", nullable=true)
     */
    private $fuiditeInternetError;

    /**
     * @ORM\OneToOne(targetEntity="Adresse")
     * @ORM\JoinColumn(name="ID_ADRESSE", referencedColumnName="ID", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\OneToOne(targetEntity="Transaction")
     * @ORM\JoinColumn(name="ID_TRANS", referencedColumnName="ID_TRANS", nullable=true)
     */
    private $transaction;

	/**
     * @return the $demenagement
     */
    public function getDemenagement()
    {
        return $this->demenagement;
    }

	/**
     * @param field_type $demenagement
     */
    public function setDemenagement($demenagement)
    {
        $this->demenagement = $demenagement;
    }

	/**
     * @return the $idAcceptation
     */
    public function getIdAcceptation()
    {
        return $this->idAcceptation;
    }

	/**
     * @param field_type $idAcceptation
     */
    public function setIdAcceptation($idAcceptation)
    {
        $this->idAcceptation = $idAcceptation;
    }

	/**
     * @return the $idTrans
     */
    public function getIdTrans()
    {
        return $this->idTrans;
    }

	/**
     * @return the $transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

	/**
     * @param field_type $idTrans
     */
    public function setIdTrans($idTrans)
    {
        $this->idTrans = $idTrans;
    }

	/**
     * @param field_type $transaction
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
    }

	/**
     * @return the $adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

	/**
     * @param field_type $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

	/**
     * @return the $idAdresse
     */
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }

	/**
     * @param field_type $idAdresse
     */
    public function setIdAdresse($idAdresse)
    {
        $this->idAdresse = $idAdresse;
    }

	/**
     * @return the $fuiditeInternetError
     */
    public function getFuiditeInternetError()
    {
        return $this->fuiditeInternetError;
    }

	/**
     * @param field_type $fuiditeInternetError
     */
    public function setFuiditeInternetError($fuiditeInternetError)
    {
        $this->fuiditeInternetError = $fuiditeInternetError;
    }

	/**
     * @return the $dateFluidite
     */
    public function getDateFluidite()
    {
        return $this->dateFluidite;
    }

	/**
     * @param field_type $dateFluidite
     */
    public function setDateFluidite($dateFluidite)
    {
        $this->dateFluidite = $dateFluidite;
    }

	/**
     * @return the $canal
     */
    public function getCanal()
    {
        return $this->canal;
    }

	/**
     * @param field_type $canal
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;
    }

	/**
     * @return the $fluiditeInternetOptions
     */
    public function getFluiditeInternetOptions()
    {
        return $this->fluiditeInternetOptions;
    }

	/**
     * @param field_type $fluiditeInternetOptions
     */
    public function setFluiditeInternetOptions($fluiditeInternetOptions)
    {
        $this->fluiditeInternetOptions = $fluiditeInternetOptions;
    }
	/**
     * @return the $idFluiditeInternet
     */
    public function getIdFluiditeInternet()
    {
        return $this->idFluiditeInternet;
    }

	/**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

	/**
     * @return the $offreSource
     */
    public function getOffreSource()
    {
        return $this->offreSource;
    }

	/**
     * @return the $offreCible
     */
    public function getOffreCible()
    {
        return $this->offreCible;
    }

	/**
     * @return the $dateDemande
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

	/**
     * @return the $dateTraitement
     */
    public function getDateTraitement()
    {
        return $this->dateTraitement;
    }

	/**
     * @return the $etat
     */
    public function getEtat()
    {
        return $this->etat;
    }

	/**
     * @param field_type $idFluiditeInternet
     */
    public function setIdFluiditeInternet($idFluiditeInternet)
    {
        $this->idFluiditeInternet = $idFluiditeInternet;
    }

	/**
     * @param field_type $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

	/**
     * @param field_type $offreSource
     */
    public function setOffreSource($offreSource)
    {
        $this->offreSource = $offreSource;
    }

	/**
     * @param field_type $offreCible
     */
    public function setOffreCible($offreCible)
    {
        $this->offreCible = $offreCible;
    }

	/**
     * @param field_type $dateDemande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;
    }

	/**
     * @param field_type $dateTraitement
     */
    public function setDateTraitement($dateTraitement)
    {
        $this->dateTraitement = $dateTraitement;
    }

	/**
     * @param field_type $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @param mixed $dateRaz
     * @return DateRaz
     */
    public function setDateRaz($dateRaz)
    {
        $this->dateRaz = $dateRaz;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateRaz()
    {
        return $this->dateRaz;
    }


}
