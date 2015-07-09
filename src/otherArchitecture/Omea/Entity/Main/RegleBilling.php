<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegleBilling
 *
 * @ORM\Table(name="REGLE_BILLING")
 * @ORM\Entity
 */
class RegleBilling
{
    /**
     * @var string
     *
     * @ORM\Column(name="HT_TTC", type="string", length=3, nullable=true)
     */
    private $htTtc;

    /**
     * @var string
     *
     * @ORM\Column(name="SIGNE", type="string", length=1, nullable=true)
     */
    private $signe;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=64, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="REGLE", type="string", length=255, nullable=true)
     */
    private $regle;

    /**
     * @var string
     *
     * @ORM\Column(name="FIXE_LIBRE", type="string", length=7, nullable=true)
     */
    private $fixeLibre;

    /**
     * @var string
     *
     * @ORM\Column(name="MONTANT", type="decimal", precision=12, scale=8, nullable=true)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="COMPTE", type="string", length=30, nullable=true)
     */
    private $compte;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="TYPO_BILLING_ID", type="integer", nullable=false)
     */
    private $typoBillingId;

    /**
     * @var string
     *
     * @ORM\Column(name="TTC", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $ttc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ACTIF", type="boolean", nullable=false)
     */
    private $actif;

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_1", type="smallint", nullable=true)
     */
    private $max1;

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_2", type="smallint", nullable=true)
     */
    private $max2;

    /**
     * @var integer
     *
     * @ORM\Column(name="MAX_3", type="smallint", nullable=true)
     */
    private $max3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="GESTECO", type="boolean", nullable=true)
     */
    private $gesteco;

    /**
     * @var boolean
     *
     * @ORM\Column(name="DISPLAY", type="boolean", nullable=false)
     */
    private $display;

    /**
     * @var boolean
     *
     * @ORM\Column(name="NBJOURREJEU", type="boolean", nullable=false)
     */
    private $nbjourrejeu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_CREATION", type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_MODIF", type="datetime", nullable=true)
     */
    private $dateModif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_INVALIDATION", type="datetime", nullable=true)
     */
    private $dateInvalidation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_SUPPR", type="datetime", nullable=true)
     */
    private $dateSuppr;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CONSEILLER", type="smallint", nullable=false)
     */
    private $idConseiller;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_EVENEMENT", type="integer", nullable=true)
     */
    private $idEvenement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="UNIVERS_MOBILE", type="boolean", nullable=true)
     */
    private $universMobile;

    /**
     * @var boolean
     *
     * @ORM\Column(name="UNIVERS_ADSL", type="boolean", nullable=true)
     */
    private $universAdsl;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_COMPTABLE", type="string", length=3)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeComptable;

    /**
     * @param boolean $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param string $codeComptable
     */
    public function setCodeComptable($codeComptable)
    {
        $this->codeComptable = $codeComptable;
    }

    /**
     * @return string
     */
    public function getCodeComptable()
    {
        return $this->codeComptable;
    }

    /**
     * @param string $compte
     */
    public function setCompte($compte)
    {
        $this->compte = $compte;
    }

    /**
     * @return string
     */
    public function getCompte()
    {
        return $this->compte;
    }

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateInvalidation
     */
    public function setDateInvalidation($dateInvalidation)
    {
        $this->dateInvalidation = $dateInvalidation;
    }

    /**
     * @return \DateTime
     */
    public function getDateInvalidation()
    {
        return $this->dateInvalidation;
    }

    /**
     * @param \DateTime $dateModif
     */
    public function setDateModif($dateModif)
    {
        $this->dateModif = $dateModif;
    }

    /**
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->dateModif;
    }

    /**
     * @param \DateTime $dateSuppr
     */
    public function setDateSuppr($dateSuppr)
    {
        $this->dateSuppr = $dateSuppr;
    }

    /**
     * @return \DateTime
     */
    public function getDateSuppr()
    {
        return $this->dateSuppr;
    }

    /**
     * @param boolean $display
     */
    public function setDisplay($display)
    {
        $this->display = $display;
    }

    /**
     * @return boolean
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @param string $fixeLibre
     */
    public function setFixeLibre($fixeLibre)
    {
        $this->fixeLibre = $fixeLibre;
    }

    /**
     * @return string
     */
    public function getFixeLibre()
    {
        return $this->fixeLibre;
    }

    /**
     * @param boolean $gesteco
     */
    public function setGesteco($gesteco)
    {
        $this->gesteco = $gesteco;
    }

    /**
     * @return boolean
     */
    public function getGesteco()
    {
        return $this->gesteco;
    }

    /**
     * @param string $htTtc
     */
    public function setHtTtc($htTtc)
    {
        $this->htTtc = $htTtc;
    }

    /**
     * @return string
     */
    public function getHtTtc()
    {
        return $this->htTtc;
    }

    /**
     * @param int $idConseiller
     */
    public function setIdConseiller($idConseiller)
    {
        $this->idConseiller = $idConseiller;
    }

    /**
     * @return int
     */
    public function getIdConseiller()
    {
        return $this->idConseiller;
    }

    /**
     * @param int $idEvenement
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;
    }

    /**
     * @return int
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param int $max1
     */
    public function setMax1($max1)
    {
        $this->max1 = $max1;
    }

    /**
     * @return int
     */
    public function getMax1()
    {
        return $this->max1;
    }

    /**
     * @param int $max2
     */
    public function setMax2($max2)
    {
        $this->max2 = $max2;
    }

    /**
     * @return int
     */
    public function getMax2()
    {
        return $this->max2;
    }

    /**
     * @param int $max3
     */
    public function setMax3($max3)
    {
        $this->max3 = $max3;
    }

    /**
     * @return int
     */
    public function getMax3()
    {
        return $this->max3;
    }

    /**
     * @param string $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param boolean $nbjourrejeu
     */
    public function setNbjourrejeu($nbjourrejeu)
    {
        $this->nbjourrejeu = $nbjourrejeu;
    }

    /**
     * @return boolean
     */
    public function getNbjourrejeu()
    {
        return $this->nbjourrejeu;
    }

    /**
     * @param string $regle
     */
    public function setRegle($regle)
    {
        $this->regle = $regle;
    }

    /**
     * @return string
     */
    public function getRegle()
    {
        return $this->regle;
    }

    /**
     * @param string $signe
     */
    public function setSigne($signe)
    {
        $this->signe = $signe;
    }

    /**
     * @return string
     */
    public function getSigne()
    {
        return $this->signe;
    }

    /**
     * @param string $ttc
     */
    public function setTtc($ttc)
    {
        $this->ttc = $ttc;
    }

    /**
     * @return string
     */
    public function getTtc()
    {
        return $this->ttc;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $typoBillingId
     */
    public function setTypoBillingId($typoBillingId)
    {
        $this->typoBillingId = $typoBillingId;
    }

    /**
     * @return int
     */
    public function getTypoBillingId()
    {
        return $this->typoBillingId;
    }

    /**
     * @param boolean $universAdsl
     */
    public function setUniversAdsl($universAdsl)
    {
        $this->universAdsl = $universAdsl;
    }

    /**
     * @return boolean
     */
    public function getUniversAdsl()
    {
        return $this->universAdsl;
    }

    /**
     * @param boolean $universMobile
     */
    public function setUniversMobile($universMobile)
    {
        $this->universMobile = $universMobile;
    }

    /**
     * @return boolean
     */
    public function getUniversMobile()
    {
        return $this->universMobile;
    }

}
