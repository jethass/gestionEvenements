<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="LIGNE_ADSL")
 * @ORM\Entity
 */
class LigneAdsl
{

    /**
     *
     * @var integer
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var integer
     * @ORM\Column(name="STATUT_LIGNE", type="string", length=10, nullable=true)
     */
    private $statutLigne;

    /**
     *
     * @var integer
     * @ORM\Column(name="ID_CONTRAT", type="integer")
     */
    private $idContrat;

    /**
     * @ORM\ManyToOne(targetEntity="Contrat", inversedBy="ligneAdsl")
     * @ORM\JoinColumn(name="ID_CONTRAT", referencedColumnName="ID_CONTRAT", nullable=true)
     */
    private $contrat;

    /**
     *
     * @var integer
     * @ORM\Column(name="NDI", type="string", length=10, nullable=true)
     */
    private $ndi;

    /**
     *
     * @var integer
     * @ORM\Column(name="NUMERO_USUEL", type="string", length=10, nullable=true)
     */
    private $numeroUsuel;

    /**
     *
     * @var boolean
     * @ORM\Column(name="EST_PORTE", type="boolean", nullable=true)
     */
    private $estPorte;

    /**
     *
     * @var boolean
     * @ORM\Column(name="EST_ACTIF", type="boolean", nullable=true)
     */
    private $estActif;

    /**
     *
     * @var Adresse
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumn(name="ID_ADRESSES", referencedColumnName="ID", nullable=true)
     */
    private $adresse;

    /**
     *
     * @var integer
     * @ORM\Column(name="ELIGIBILITE", type="string", length=10, nullable=true)
     */
    private $eligibilite;

    /**
     *
     * @var integer
     * @ORM\Column(name="DEBIT_MONTANT_MAX", type="integer", length=11, nullable=true)
     */
    private $debitMontantMax;

    /**
     *
     * @var integer
     * @ORM\Column(name="DEBIT_DESCENDANT_MAX", type="integer", length=11, nullable=true)
     */
    private $debitDescendantMax;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="ELIG_DATE_DISPO_TV", type="datetime", nullable=true)
     */
    private $eligDateDispoTv;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="ELIG_DATE_DISPO_VOIP", type="datetime", nullable=true)
     */
    private $eligDateDispoVoip;

    /**
     *
     * @var integer
     * @ORM\Column(name="ELIG_CODE_MOTIF", type="string", length=255, nullable=true)
     */
    private $eligCodeMotif;

    /**
     *
     * @var integer
     * @ORM\Column(name="ELIG_CODE_DEGROUPAGE", type="string", length=255, nullable=true)
     */
    private $eligCodeDegroupage;

    /**
     *
     * @var integer
     * @ORM\Column(name="ELIG_CODE_RETOUR", type="string", length=255, nullable=true)
     */
    private $eligCodeRetour;

    /**
     *
     * @var integer
     * @ORM\Column(name="ELIG_MESSAGE_MOTIF", type="string", length=255, nullable=true)
     */
    private $eligMessageMotif;

    /**
     *
     * @var integer
     * @ORM\Column(name="ELIG_CODE_ELIGIBILITE", type="string", length=255, nullable=true)
     */
    private $eligCodeEligibilite;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="ELIG_DATE_DISPO_PORTA", type="datetime", nullable=true)
     */
    private $eligDateDispoPorta;

    /**
     *
     * @var integer
     * @ORM\Column(name="NUMERO_FT", type="string", length=255, nullable=true)
     */
    private $numeroFt;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="DATE_TEST_ELIGIBILITE", type="datetime", nullable=true)
     */
    private $dateTestEligibilite;

    /**
     *
     * @var integer
     * @ORM\Column(name="PROFIL_DEGROUPAGE", type="string", nullable=true)
     */
    private $profilDegroupage;

    /**
     *
     * @var integer
     * @ORM\Column(name="URA_CODE", type="string", length=3, nullable=true)
     */
    private $uraCode;

    /**
     *
     * @var integer
     * @ORM\Column(name="URA_CODE_BATIMENT", type="string", length=20, nullable=true)
     */
    private $uraCodeBatiment;

    /**
     *
     * @var integer
     * @ORM\Column(name="URA_ID", type="string", length=5, nullable=true)
     */
    private $uraId;

    /**
     *
     * @var integer
     * @ORM\Column(name="URA_INSEE", type="string", length=5, nullable=true)
     */
    private $uraInsee;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="DATE_CREATION", type="datetime")
     */
    private $dateCreation;

    /**
     *
     * @var \DateTime
     * @ORM\Column(name="DATE_MODIFICATION", type="datetime")
     */
    private $dateModification;

    /**
     *
     * @var integer
     * @ORM\Column(name="ELIG_ID_REQUETE", type="string", length=255, nullable=true)
     */
    private $eligIdRequete;

    /**
     *
     * @var integer
     * @ORM\Column(name="ID_ART", type="integer", length=10, nullable=true)
     */
    private $idArt;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName="ID_ART")
     */
    private $article;

    /**
     *
     * @var integer
     * @ORM\Column(name="DATE_RESILIATION_CONTRAT", type="string", length=10, nullable=true)
     */
    private $dateResiliationContrat;

    /**
     * @param field_type $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

	/**
     * @return the $idContrat
     */
    public function getIdContrat()
    {
        return $this->idContrat;
    }

    /**
     * @param number $idContrat
     */
    public function setIdContrat($idContrat)
    {
        $this->idContrat = $idContrat;
    }

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return the $statutLigne
     */
    public function getStatutLigne()
    {
        return $this->statutLigne;
    }

    /**
     * @return Contrat $contrat
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     * @return the $ndi
     */
    public function getNdi()
    {
        return $this->ndi;
    }

    /**
     * @return the $numeroUsuel
     */
    public function getNumeroUsuel()
    {
        return $this->numeroUsuel;
    }

    /**
     * @return the $estPorte
     */
    public function getEstPorte()
    {
        return $this->estPorte;
    }

    /**
     * @return the $estActif
     */
    public function getEstActif()
    {
        return $this->estActif;
    }

    /**
     * @return Adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return the $eligibilite
     */
    public function getEligibilite()
    {
        return $this->eligibilite;
    }

    /**
     * @return the $debitMontantMax
     */
    public function getDebitMontantMax()
    {
        return $this->debitMontantMax;
    }

    /**
     * @return the $debitDescendantMax
     */
    public function getDebitDescendantMax()
    {
        return $this->debitDescendantMax;
    }

    /**
     * @return the $eligDateDispoTv
     */
    public function getEligDateDispoTv()
    {
        return $this->eligDateDispoTv;
    }

    /**
     * @return the $eligDateDispoVoip
     */
    public function getEligDateDispoVoip()
    {
        return $this->eligDateDispoVoip;
    }

    /**
     * @return the $eligCodeMotif
     */
    public function getEligCodeMotif()
    {
        return $this->eligCodeMotif;
    }

    /**
     * @return the $eligCodeDegroupage
     */
    public function getEligCodeDegroupage()
    {
        return $this->eligCodeDegroupage;
    }

    /**
     * @return the $eligCodeRetour
     */
    public function getEligCodeRetour()
    {
        return $this->eligCodeRetour;
    }

    /**
     * @return the $eligMessageMotif
     */
    public function getEligMessageMotif()
    {
        return $this->eligMessageMotif;
    }

    /**
     * @return the $eligCodeEligibilite
     */
    public function getEligCodeEligibilite()
    {
        return $this->eligCodeEligibilite;
    }

    /**
     * @return the $eligDateDispoPorta
     */
    public function getEligDateDispoPorta()
    {
        return $this->eligDateDispoPorta;
    }

    /**
     * @return the $numeroFt
     */
    public function getNumeroFt()
    {
        return $this->numeroFt;
    }

    /**
     * @return the $dateTestEligibilite
     */
    public function getDateTestEligibilite()
    {
        return $this->dateTestEligibilite;
    }

    /**
     * @return the $profilDegroupage
     */
    public function getProfilDegroupage()
    {
        return $this->profilDegroupage;
    }

    /**
     * @return the $uraCode
     */
    public function getUraCode()
    {
        return $this->uraCode;
    }

    /**
     * @return the $uraCodeBatiment
     */
    public function getUraCodeBatiment()
    {
        return $this->uraCodeBatiment;
    }

    /**
     * @return the $uraId
     */
    public function getUraId()
    {
        return $this->uraId;
    }

    /**
     * @return the $uraInsee
     */
    public function getUraInsee()
    {
        return $this->uraInsee;
    }

    /**
     * @return the $dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @return the $dateModification
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * @return the $eligIdRequete
     */
    public function getEligIdRequete()
    {
        return $this->eligIdRequete;
    }

    /**
     * @return the $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     * @return the $dateResiliationContrat
     */
    public function getDateResiliationContrat()
    {
        return $this->dateResiliationContrat;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param number $statutLigne
     */
    public function setStatutLigne($statutLigne)
    {
        $this->statutLigne = $statutLigne;
    }

    /**
     * @param field_type $contrat
     */
    public function setContrat($contrat)
    {
        $this->contrat = $contrat;
    }

    /**
     * @param number $ndi
     */
    public function setNdi($ndi)
    {
        $this->ndi = $ndi;
    }

    /**
     * @param number $numeroUsuel
     */
    public function setNumeroUsuel($numeroUsuel)
    {
        $this->numeroUsuel = $numeroUsuel;
    }

    /**
     * @param boolean $estPorte
     */
    public function setEstPorte($estPorte)
    {
        $this->estPorte = $estPorte;
    }

    /**
     * @param boolean $estActif
     */
    public function setEstActif($estActif)
    {
        $this->estActif = $estActif;
    }

    /**
     * @param \Omea\Entity\Main\Adresse $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @param number $eligibilite
     */
    public function setEligibilite($eligibilite)
    {
        $this->eligibilite = $eligibilite;
    }

    /**
     * @param number $debitMontantMax
     */
    public function setDebitMontantMax($debitMontantMax)
    {
        $this->debitMontantMax = $debitMontantMax;
    }

    /**
     * @param number $debitDescendantMax
     */
    public function setDebitDescendantMax($debitDescendantMax)
    {
        $this->debitDescendantMax = $debitDescendantMax;
    }

    /**
     * @param DateTime $eligDateDispoTv
     */
    public function setEligDateDispoTv($eligDateDispoTv)
    {
        $this->eligDateDispoTv = $eligDateDispoTv;
    }

    /**
     * @param DateTime $eligDateDispoVoip
     */
    public function setEligDateDispoVoip($eligDateDispoVoip)
    {
        $this->eligDateDispoVoip = $eligDateDispoVoip;
    }

    /**
     * @param number $eligCodeMotif
     */
    public function setEligCodeMotif($eligCodeMotif)
    {
        $this->eligCodeMotif = $eligCodeMotif;
    }

    /**
     * @param number $eligCodeDegroupage
     */
    public function setEligCodeDegroupage($eligCodeDegroupage)
    {
        $this->eligCodeDegroupage = $eligCodeDegroupage;
    }

    /**
     * @param number $eligCodeRetour
     */
    public function setEligCodeRetour($eligCodeRetour)
    {
        $this->eligCodeRetour = $eligCodeRetour;
    }

    /**
     * @param number $eligMessageMotif
     */
    public function setEligMessageMotif($eligMessageMotif)
    {
        $this->eligMessageMotif = $eligMessageMotif;
    }

    /**
     * @param number $eligCodeEligibilite
     */
    public function setEligCodeEligibilite($eligCodeEligibilite)
    {
        $this->eligCodeEligibilite = $eligCodeEligibilite;
    }

    /**
     * @param DateTime $eligDateDispoPorta
     */
    public function setEligDateDispoPorta($eligDateDispoPorta)
    {
        $this->eligDateDispoPorta = $eligDateDispoPorta;
    }

    /**
     * @param number $numeroFt
     */
    public function setNumeroFt($numeroFt)
    {
        $this->numeroFt = $numeroFt;
    }

    /**
     * @param DateTime $dateTestEligibilite
     */
    public function setDateTestEligibilite($dateTestEligibilite)
    {
        $this->dateTestEligibilite = $dateTestEligibilite;
    }

    /**
     * @param number $profilDegroupage
     */
    public function setProfilDegroupage($profilDegroupage)
    {
        $this->profilDegroupage = $profilDegroupage;
    }

    /**
     * @param number $uraCode
     */
    public function setUraCode($uraCode)
    {
        $this->uraCode = $uraCode;
    }

    /**
     * @param number $uraCodeBatiment
     */
    public function setUraCodeBatiment($uraCodeBatiment)
    {
        $this->uraCodeBatiment = $uraCodeBatiment;
    }

    /**
     * @param number $uraId
     */
    public function setUraId($uraId)
    {
        $this->uraId = $uraId;
    }

    /**
     * @param number $uraInsee
     */
    public function setUraInsee($uraInsee)
    {
        $this->uraInsee = $uraInsee;
    }

    /**
     * @param DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @param DateTime $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    /**
     * @param number $eligIdRequete
     */
    public function setEligIdRequete($eligIdRequete)
    {
        $this->eligIdRequete = $eligIdRequete;
    }

    /**
     * @param number $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param number $dateResiliationContrat
     */
    public function setDateResiliationContrat($dateResiliationContrat)
    {
        $this->dateResiliationContrat = $dateResiliationContrat;
    }

}
