<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="CLIENT")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ClientRepository")
 */
class Client
{
    /**
     *
     * @var integer $idClient
     *
     * @ORM\Column(name="ID_CLIENT", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idClient;

    /**
     *
     * @var string $numHighdeal
     *
     * @ORM\Column(name="NUM_HIGHDEAL", type="string", length=255, nullable=true)
     */
    private $numHighdeal;

    /**
     * @ORM\ManyToOne(targetEntity="Contrat", inversedBy="client")
     * @ORM\JoinColumn(name="ID_CONTRAT", referencedColumnName="ID_CONTRAT", nullable=true)
     */
    private $contrat;

    /**
     * @ORM\OneToOne(targetEntity="ClientAnnu", cascade={"persist"}, mappedBy="client")
     */
    private $clientAnnu;

    /**
     *
     * @var integer $etat
     *
     * @ORM\Column(name="ETAT", type="integer", length=4)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Civilite")
     * @ORM\JoinColumn(name="CIVILITE", referencedColumnName = "ID_CIV")
     */
    private $civilite;

    /**
     *
     * @var string $nom
     * @Assert\NotBlank()
     * @ORM\Column(name="NOM", type="string", length=765)
     */
    private $nom;

    /**
     *
     * @var string $prenom
     * @Assert\NotBlank()
     * @ORM\Column(name="PRENOM", type="string", length=765)
     */
    private $prenom;

    /**
     *
     * @var string $numeroRue
     *
     * @ORM\Column(name="NUMERO_RUE", type="string", length=30)
     */
    private $numeroRue;

    /**
     *
     * @var text $adresse
     *
     * @ORM\Column(name="ADRESSE", type="text")
     */
    private $adresse;

    /**
     *
     * @var text $adresseComplement
     *
     * @ORM\Column(name="ADRESSE_COMPLEMENT", type="text")
     */
    private $adresseComplement;

    /**
     *
     * @var integer $codePos
     *
     * @ORM\Column(name="CODPOS", type="integer")
     */
    private $codePos;

    /**
     *
     * @var string $ville
     *
     * @ORM\Column(name="VILLE", type="string", length=255)
     */
    private $ville;

    /**
     *
     * @var string $email
     * @Assert\Email()
     * @ORM\Column(name="EMAIL", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     *
     * @var string $telephone
     * @Assert\Regex("#^0[1-9][0-9]{8}$#")
     * @ORM\Column(name="TELEPHONE", type="string", length=60, nullable=true)
     */
    private $telephone;

    /**
     *
     * @var string $telephone
     * @Assert\Regex("#^0[1-9][0-9]{8}$#")
     * @ORM\Column(name="TELEPHONE_2", type="string", length=60, nullable=true)
     */
    private $telephone2;

    /**
     *
     * @var string $telephone
     * @Assert\Regex("#^0[1-9][0-9]{8}$#")
     * @ORM\Column(name="TELEPHONE_3", type="string", length=60, nullable=true)
     */
    private $telephone3;

    /**
     *
     * @var string $mobile
     * @Assert\Regex("#^0[1-9][0-9]{8}$#")
     * @ORM\Column(name="MOBILE", type="string", length=30, nullable=true)
     */
    private $mobile;

    /**
     *
     * @var date $birthday
     *
     * @ORM\Column(name="BIRTHDAY", type="date", nullable=true)
     */
    private $birthday;

    /**
     *
     * @var integer $departementBirthday
     *
     * @ORM\Column(name="DPT_BIRTHDAY", type="integer", nullable=true)
     */
    private $dptBirthday;

    /**
     *
     * @var string $communeBirthday
     *
     * @ORM\Column(name="COMMUNE_BIRTHDAY", type="string", length=450, nullable=true)
     */
    private $communeBirthday;

    /**
     *
     * @var string $civiliteFac
     *
     * @ORM\Column(name="CIVILITEFAC", type="integer")
     */
    private $civiliteFac;

    /**
     * @ORM\ManyToOne(targetEntity="Civilite")
     * @ORM\JoinColumn(name="CIVILITEFAC", referencedColumnName = "ID_CIV")
     */
    private $civiliteFacture;

    /**
     *
     * @var string $nomFac
     *
     * @ORM\Column(name="NOMFAC", type="string", length=255, nullable=true)
     */
    private $nomFac;

    /**
     *
     * @var string $prenomFac
     *
     * @ORM\Column(name="PRENOMFAC", type="string", length=255, nullable=true)
     */
    private $prenomFac;

    /**
     *
     * @var string $numeroRueFac
     *
     * @ORM\Column(name="NUMERO_RUE_FAC", type="string", length=30)
     */
    private $numeroRueFac;

    /**
     *
     * @var string $adresseFac
     *
     * @ORM\Column(name="ADRESSEFAC", type="string", length=255, nullable=true)
     */
    private $adresseFac;

    /**
     *
     * @var text $adressefacComplement
     *
     * @ORM\Column(name="ADRESSEFAC_COMPLEMENT", type="text")
     */
    private $adressefacComplement;

    /**
     *
     * @var integer $codePosFac
     *
     * @ORM\Column(name="CODPOSFAC", type="integer", nullable=true)
     */
    private $codePosFac;

    /**
     *
     * @var string $villeFac
     *
     * @ORM\Column(name="VILLEFAC", type="string", length=765, nullable=true)
     */
    private $villeFac;

    /**
     *
     * @var string $raisonSoc
     *
     * @ORM\Column(name="RAISONSOC", type="string", length=765, nullable=true)
     */
    private $raisonSoc;

    /**
     *
     * @var string $formeSoc
     *
     * @ORM\Column(name="FORMESOC", type="string", length=765, nullable=true)
     */
    private $formeSoc;

    /**
     *
     * @var string $capitalSoc
     *
     * @ORM\Column(name="CAPITALSOC", type="string", length=765, nullable=true)
     */
    private $capitalSoc;

    /**
     *
     * @var text $adresseSoc
     *
     * @ORM\Column(name="ADRESSESOC", type="text", nullable=true)
     */
    private $adresseSoc;

    /**
     *
     * @var string $sirenSoc
     *
     * @ORM\Column(name="SIRENSOC", type="string", length=765, nullable=true)
     */
    private $sirenSoc;

    /**
     * @ORM\ManyToOne(targetEntity="Cycle")
     * @ORM\JoinColumn(name="CYCLE", referencedColumnName = "CYCLE")
     */
    private $cycle;

    /**
     *
     * @var string $password
     *
     * @ORM\Column(name="PASSWORD", type="string", length=96, nullable=true)
     */
    private $password;

    /**
     *
     * @var integer $optNewsletter
     *
     * @ORM\Column(name="OPT_NEWSLETTER", type="integer")
     */
    private $optNewsletter;

    /**
     *
     * @var integer $optnNewsletterCommercial
     *
     * @ORM\Column(name="OPT_NEWSLETTER_COMMERCIAL", type="integer")
     */
    private $optNewsletterCommercial;

    /**
     *
     * @var boolean $ouiAnnu
     *
     * @ORM\Column(name="oui_annu", type="boolean")
     */
    private $ouiAnnu = false;

    /**
     *
     * @var boolean $ouiAnnuSociete
     *
     * @ORM\Column(name="oui_annu_societe", type="boolean")
     */
    private $ouiAnnuSociete = false;

    /**
     *
     * @var boolean $ouiAnnuInverse
     *
     * @ORM\Column(name="oui_annu_inverse", type="boolean")
     */
    private $ouiAnnuInverse = false;

    /**
     *
     * @var string $nomUtil
     *
     * @ORM\Column(name="NOM_UTIL", type="string", length=90, nullable=true)
     */
    private $nomUtil;

    /**
     *
     * @var string $prenomUtil
     *
     * @ORM\Column(name="PRENOM_UTIL", type="string", length=105, nullable=true)
     */
    private $prenomUtil;

    /**
     *
     * @var date $birthUtil
     *
     * @ORM\Column(name="BIRTH_UTIL", type="date", nullable=true)
     */
    private $birthUtil;

    /**
     *
     * @var integer $idFai
     *
     * @ORM\Column(name="ID_FAI", type="integer")
     */
    private $idFai;

    /**
     *
     * @var integer $billingSubscribed
     *
     * @ORM\Column(name="BILLING_SUBSCRIBED", type="integer")
     */
    private $billingSubscribed;

    /**
     *
     * @var string $typeClient
     *
     * @ORM\Column(name="TYPE_CLIENT", type="string", length=30, nullable=true)
     */
    private $typeClient;

    /**
     *
     * @var string @ORM\Column(name="NB_PERS_FOYER", type="integer")
     */
    private $nbPersFoyer;

    /**
     * @ORM\OneToOne(targetEntity="Foyer", cascade={"all"})
     * @ORM\JoinColumn(name="ID_FOYER", referencedColumnName = "ID")
     */
    private $foyer;

    /**
     * @var Adresse $adresseTitulaire
     * @ORM\OneToOne(targetEntity="Adresse", cascade={"persist", "merge"})
     * @ORM\JoinColumn(name="ID_ADRESSE_TITU", referencedColumnName = "ID")
     */
    private $adresseTitulaire;

    /**
     *
     * @var integer $idClientPro
     *
     * @ORM\OneToOne(targetEntity="ClientPro", cascade={"persist"})
     * @ORM\JoinColumn(name="ID_CLIENT_PRO", referencedColumnName="ID_CLIENT_PRO")
     */
    private $clientPro;

    /**
     * @ORM\OneToMany(targetEntity="StockMsisdn", mappedBy="client")
     */
    private $stockMsisdn;

    /**
     * @ORM\OneToMany(targetEntity="OptionsClient", mappedBy="client")
     */
    private $optionsClient;

    /**
     * @ORM\OneToMany(targetEntity="PassClient", mappedBy="client")
     */
    private $passClient;

    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="client")
     */
    private $transaction;

    /**
     * @ORM\OneToMany(targetEntity="Engagement", mappedBy="client")
     */
    private $engagements;

    /**
     * @ORM\OneToMany(targetEntity="Resiliation", mappedBy="client")
     */
    private $resiliations;

    /**
     * @ORM\OneToMany(targetEntity="Billing", mappedBy="client")
     */
    private $billings;

    public function __construct()
    {
        $this->stockMsisdn  = new ArrayCollection();
        $this->engagements  = new ArrayCollection();
        $this->resiliations = new ArrayCollection();
        $this->billings     = new ArrayCollection();
    }

    /**
     *
     * @return the $clientAnnu
     */
    public function getClientAnnu()
    {
        return $this->clientAnnu;
    }

    /**
     *
     * @param field_type $clientAnnu
     */
    public function setClientAnnu($clientAnnu)
    {
        $this->clientAnnu = $clientAnnu;
    }

    /**
     *
     * @return the $passClient
     */
    public function getPassClient()
    {
        return $this->passClient;
    }

    /**
     *
     * @param field_type $passClient
     */
    public function setPassClient($passClient)
    {
        $this->passClient = $passClient;
    }

    /**
     *
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     *
     * @return the $numHighdeal
     */
    public function getNumHighdeal()
    {
        return $this->numHighdeal;
    }

    /**
     *
     * @return the $contrat
     */
    public function getContrat()
    {
        return $this->contrat;
    }

    /**
     *
     * @return the $etat
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     *
     * @return the $civilite
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     *
     * @return the $nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *
     * @return the $prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     *
     * @return the $numeroRue
     */
    public function getNumeroRue()
    {
        return $this->numeroRue;
    }

    /**
     *
     * @return the $adresse
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     *
     * @return the $adresseComplement
     */
    public function getAdresseComplement()
    {
        return $this->adresseComplement;
    }

    /**
     *
     * @return the $codePos
     */
    public function getCodePos()
    {
        return $this->codePos;
    }

    /**
     *
     * @return the $ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     *
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return the $telephone
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     *
     * @return the $telephone2
     */
    public function getTelephone2()
    {
        return $this->telephone2;
    }

    /**
     *
     * @return the $telephone3
     */
    public function getTelephone3()
    {
        return $this->telephone3;
    }

    /**
     *
     * @return the $mobile
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     *
     * @return the $birthday
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     *
     * @return the $dptBirthday
     */
    public function getDptBirthday()
    {
        return $this->dptBirthday;
    }

    /**
     *
     * @return the $communeBirthday
     */
    public function getCommuneBirthday()
    {
        return $this->communeBirthday;
    }

    /**
     *
     * @return the $civiliteFacture
     */
    public function getCiviliteFacture()
    {
        return $this->civiliteFacture;
    }

    /**
     *
     * @return the $nomFac
     */
    public function getNomFac()
    {
        return $this->nomFac;
    }

    /**
     *
     * @return the $prenomFac
     */
    public function getPrenomFac()
    {
        return $this->prenomFac;
    }

    /**
     *
     * @return the $numeroRueFac
     */
    public function getNumeroRueFac()
    {
        return $this->numeroRueFac;
    }

    /**
     *
     * @return the $adresseFac
     */
    public function getAdresseFac()
    {
        return $this->adresseFac;
    }

    /**
     *
     * @return the $adressefacComplement
     */
    public function getAdressefacComplement()
    {
        return $this->adressefacComplement;
    }

    /**
     *
     * @return the $codePosFac
     */
    public function getCodePosFac()
    {
        return $this->codePosFac;
    }

    /**
     *
     * @return the $villeFac
     */
    public function getVilleFac()
    {
        return $this->villeFac;
    }

    /**
     *
     * @return the $raisonSoc
     */
    public function getRaisonSoc()
    {
        return $this->raisonSoc;
    }

    /**
     *
     * @return the $formeSoc
     */
    public function getFormeSoc()
    {
        return $this->formeSoc;
    }

    /**
     *
     * @return the $capitalSoc
     */
    public function getCapitalSoc()
    {
        return $this->capitalSoc;
    }

    /**
     *
     * @return the $adresseSoc
     */
    public function getAdresseSoc()
    {
        return $this->adresseSoc;
    }

    /**
     *
     * @return the $sirenSoc
     */
    public function getSirenSoc()
    {
        return $this->sirenSoc;
    }

    /**
     *
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *
     * @return the $optNewsletter
     */
    public function getOptNewsletter()
    {
        return $this->optNewsletter;
    }

    /**
     *
     * @return the $optNewsletterCommercial
     */
    public function getOptNewsletterCommercial()
    {
        return $this->optNewsletterCommercial;
    }

    /**
     *
     * @return the $ouiAnnu
     */
    public function getOuiAnnu()
    {
        return $this->ouiAnnu;
    }

    /**
     *
     * @return the $ouiAnnuSociete
     */
    public function getOuiAnnuSociete()
    {
        return $this->ouiAnnuSociete;
    }

    /**
     *
     * @return the $ouiAnnuInverse
     */
    public function getOuiAnnuInverse()
    {
        return $this->ouiAnnuInverse;
    }

    /**
     *
     * @return the $nomUtil
     */
    public function getNomUtil()
    {
        return $this->nomUtil;
    }

    /**
     *
     * @return the $prenomUtil
     */
    public function getPrenomUtil()
    {
        return $this->prenomUtil;
    }

    /**
     *
     * @return the $birthUtil
     */
    public function getBirthUtil()
    {
        return $this->birthUtil;
    }

    /**
     *
     * @return the $idFai
     */
    public function getIdFai()
    {
        return $this->idFai;
    }

    /**
     *
     * @return the $billingSubscribed
     */
    public function getBillingSubscribed()
    {
        return $this->billingSubscribed;
    }

    /**
     *
     * @return the $typeClient
     */
    public function getTypeClient()
    {
        return $this->typeClient;
    }

    /**
     *
     * @return the $foyer
     */
    public function getFoyer()
    {
        return $this->foyer;
    }

    /**
     *
     * @return the $adresseTitulaire
     */
    public function getAdresseTitulaire()
    {
        return $this->adresseTitulaire;
    }

    /**
     *
     * @return the $clientPro
     */
    public function getClientPro()
    {
        return $this->clientPro;
    }

    /**
     *
     * @return the $filleuls
     */
    public function getFilleuls()
    {
        return $this->filleuls;
    }

    /**
     *
     * @return the $stockmsisdn
     */
    public function getStockMsisdn()
    {
        return $this->stockMsisdn;
    }

    /**
     *
     * @return the $optionsClient
     */
    public function getOptionsClient()
    {
        return $this->optionsClient;
    }

    /**
     *
     * @param number $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     *
     * @param string $numHighdeal
     */
    public function setNumHighdeal($numHighdeal)
    {
        $this->numHighdeal = $numHighdeal;
    }

    /**
     *
     * @param field_type $contrat
     */
    public function setContrat($contrat)
    {
        $this->contrat = $contrat;
    }

    /**
     *
     * @param number $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     *
     * @param field_type $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     *
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     *
     * @param string $numeroRue
     */
    public function setNumeroRue($numeroRue)
    {
        $this->numeroRue = $numeroRue;
    }

    /**
     *
     * @param \Omea\Entity\Main\text $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     *
     * @param \Omea\Entity\Main\text $adresseComplement
     */
    public function setAdresseComplement($adresseComplement)
    {
        $this->adresseComplement = $adresseComplement;
    }

    /**
     *
     * @param number $codePos
     */
    public function setCodePos($codePos)
    {
        $this->codePos = $codePos;
    }

    /**
     *
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     *
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     *
     * @param string $telephone
     */
    public function setTelephone2($telephone)
    {
        $this->telephone2 = $telephone;
    }

    /**
     *
     * @param string $telephone
     */
    public function setTelephone3($telephone)
    {
        $this->telephone3 = $telephone;
    }

    /**
     *
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     *
     * @param \Omea\Entity\Main\date $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     *
     * @param number $dptBirthday
     */
    public function setDptBirthday($dptBirthday)
    {
        $this->dptBirthday = $dptBirthday;
    }

    /**
     *
     * @param string $communeBirthday
     */
    public function setCommuneBirthday($communeBirthday)
    {
        $this->communeBirthday = $communeBirthday;
    }

    /**
     *
     * @param field_type $civiliteFacture
     */
    public function setCiviliteFacture($civiliteFacture)
    {
        $this->civiliteFacture = $civiliteFacture;
    }

    /**
     *
     * @param string $nomFac
     */
    public function setNomFac($nomFac)
    {
        $this->nomFac = $nomFac;
    }

    /**
     *
     * @param string $prenomFac
     */
    public function setPrenomFac($prenomFac)
    {
        $this->prenomFac = $prenomFac;
    }

    /**
     *
     * @param string $numeroRueFac
     */
    public function setNumeroRueFac($numeroRueFac)
    {
        $this->numeroRueFac = $numeroRueFac;
    }

    /**
     *
     * @param string $adresseFac
     */
    public function setAdresseFac($adresseFac)
    {
        $this->adresseFac = $adresseFac;
    }

    /**
     *
     * @param \Omea\Entity\Main\text $adressefacComplement
     */
    public function setAdressefacComplement($adressefacComplement)
    {
        $this->adressefacComplement = $adressefacComplement;
    }

    /**
     *
     * @param number $codePosFac
     */
    public function setCodePosFac($codePosFac)
    {
        $this->codePosFac = $codePosFac;
    }

    /**
     *
     * @param string $villeFac
     */
    public function setVilleFac($villeFac)
    {
        $this->villeFac = $villeFac;
    }

    /**
     *
     * @param string $raisonSoc
     */
    public function setRaisonSoc($raisonSoc)
    {
        $this->raisonSoc = $raisonSoc;
    }

    /**
     *
     * @param string $formeSoc
     */
    public function setFormeSoc($formeSoc)
    {
        $this->formeSoc = $formeSoc;
    }

    /**
     *
     * @param string $capitalSoc
     */
    public function setCapitalSoc($capitalSoc)
    {
        $this->capitalSoc = $capitalSoc;
    }

    /**
     *
     * @param \Omea\Entity\Main\text $adresseSoc
     */
    public function setAdresseSoc($adresseSoc)
    {
        $this->adresseSoc = $adresseSoc;
    }

    /**
     *
     * @param string $sirenSoc
     */
    public function setSirenSoc($sirenSoc)
    {
        $this->sirenSoc = $sirenSoc;
    }

    /**
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     *
     * @param number $optNewsletter
     */
    public function setOptNewsletter($optNewsletter)
    {
        $this->optNewsletter = $optNewsletter;
    }

    /**
     *
     * @param number $optNewsletterCommercial
     */
    public function setOptNewsletterCommercial($optNewsletterCommercial)
    {
        $this->optNewsletterCommercial = $optNewsletterCommercial;
    }

    /**
     *
     * @param boolean $ouiAnnu
     */
    public function setOuiAnnu($ouiAnnu)
    {
        $this->ouiAnnu = $ouiAnnu;
    }

    /**
     *
     * @param boolean $ouiAnnuSociete
     */
    public function setOuiAnnuSociete($ouiAnnuSociete)
    {
        $this->ouiAnnuSociete = $ouiAnnuSociete;
    }

    /**
     *
     * @param boolean $ouiAnnuInverse
     */
    public function setOuiAnnuInverse($ouiAnnuInverse)
    {
        $this->ouiAnnuInverse = $ouiAnnuInverse;
    }

    /**
     *
     * @param string $nomUtil
     */
    public function setNomUtil($nomUtil)
    {
        $this->nomUtil = $nomUtil;
    }

    /**
     *
     * @param string $prenomUtil
     */
    public function setPrenomUtil($prenomUtil)
    {
        $this->prenomUtil = $prenomUtil;
    }

    /**
     *
     * @param \Omea\Entity\Main\date $birthUtil
     */
    public function setBirthUtil($birthUtil)
    {
        $this->birthUtil = $birthUtil;
    }

    /**
     *
     * @param number $idFai
     */
    public function setIdFai($idFai)
    {
        $this->idFai = $idFai;
    }

    /**
     *
     * @param number $billingSubscribed
     */
    public function setBillingSubscribed($billingSubscribed)
    {
        $this->billingSubscribed = $billingSubscribed;
    }

    /**
     *
     * @param string $typeClient
     */
    public function setTypeClient($typeClient)
    {
        $this->typeClient = $typeClient;
    }

    /**
     *
     * @param field_type $foyer
     */
    public function setFoyer($foyer)
    {
        $this->foyer = $foyer;
    }

    /**
     *
     * @param field_type $adresseTitulaire
     */
    public function setAdresseTitulaire($adresseTitulaire)
    {
        $this->adresseTitulaire = $adresseTitulaire;
    }

    /**
     *
     * @param number $clientPro
     */
    public function setClientPro($clientPro)
    {
        $this->clientPro = $clientPro;
    }

    /**
     *
     * @param field_type $filleuls
     */
    public function setFilleuls($filleuls)
    {
        $this->filleuls = $filleuls;
    }

    /**
     *
     * @param field_type $stockmsisdn
     */
    public function setStockMsisdn($stockMsisdn)
    {
        $this->stockMsisdn = $stockMsisdn;
    }

    /**
     *
     * @param field_type $optionsClient
     */
    public function setOptionsClient($optionsClient)
    {
        $this->optionsClient = $optionsClient;
    }

    public function getCycle()
    {
        return $this->cycle;
    }

    public function setCycle(Cycle $cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     *
     * @param mixed $transaction
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     *
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    public function setNbPersFoyer($nbPersFoyer)
    {
        $this->nbPersFoyer = $nbPersFoyer;
    }

    public function getNbPersFoyer()
    {
        return $this->nbPersFoyer;
    }

    /**
     *
     * @return boolean
     */
    public function estUtilisateurLigne()
    {
        $prenomUtil = $this->getPrenomUtil();
        $nomUtil = $this->getNomUtil();

        return $this->getPrenom() === $prenomUtil && $this->getNom() === $nomUtil || empty($prenomUtil) && empty($nomUtil);
    }

    /**
     * @return ArrayCollection
     */
    public function getEngagements()
    {
        return $this->engagements;
    }

    /**
     * @return ArrayCollection
     */
    public function getResiliations()
    {
        return $this->resiliations;
    }

    /**
     * @return ArrayCollection
     */
    public function getBillings()
    {
        return $this->billings;
    }
}
