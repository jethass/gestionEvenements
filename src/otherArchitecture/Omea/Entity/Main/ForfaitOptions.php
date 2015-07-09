<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FORFAIT_OPTIONS")
 * @ORM\Entity
 */
class ForfaitOptions
{

    /**
     *
     * @var integer $idForfaitOption
     *      @ORM\Column(name="ID_FORFAIT_OPTION", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idForfaitOption;

    /**
     *
     * @var integer $idArt
     *      @ORM\Column(name="ID_ART", type="integer")
     */
    private $idArt;

    /**
     *
     * @var integer $article
     *      @ORM\ManyToOne(targetEntity="Article")
     *      @ORM\JoinColumn(name="ID_ART", referencedColumnName = "ID_ART")
     */
    private $article;

    /**
     *
     * @var integer $idOption
     *      @ORM\Column(name="ID_OPTION", type="integer")
     */
    private $idOption;

    /**
     *
     * @var $options
     *      @ORM\ManyToOne(targetEntity="Options")
     *      @ORM\JoinColumn(name="ID_OPTION", referencedColumnName = "ID_OPTION")
     */
    private $option;

    /**
     *
     * @var $diseService
     *      @ORM\ManyToOne(targetEntity="DiseService", inversedBy="forfaitOption")
     *      @ORM\JoinColumn(name="TO_OMD", referencedColumnName = "ID_DS")
     */
    private $diseService;

    /**
     * @ORM\OneToMany(targetEntity="OptionsClient", mappedBy="forfaitOption")
     */
    private $optionsClient;

    /**
     *
     * @var integer $inclus
     *
     *      @ORM\Column(name="INCLUS", type="integer")
     */
    private $inclus;

    /**
     *
     * @var integer $gratuit
     *
     *      @ORM\Column(name="GRATUIT", type="integer")
     */
    private $gratuit;

    /**
     *
     * @var integer $idFormuleOpt
     *
     *      @ORM\Column(name="ID_FORMULE_OPT", type="integer")
     */
    private $idFormuleOpt;

    /**
     *
     * @var integer $actif
     *
     *      @ORM\Column(name="ACTIF", type="integer")
     */
    private $actif;

    /**
     *
     * @var integer $toSachem
     *
     *      @ORM\Column(name="TO_SACHEM", type="integer")
     */
    private $toSachem;

    /**
     *
     * @var integer $toDise
     *
     *      @ORM\Column(name="TO_DISE", type="integer")
     */
    private $toDise;

    /**
     *
     * @var integer $toOmd
     *
     *      @ORM\Column(name="TO_OMD", type="integer")
     */
    private $toOmd;

    /**
     *
     * @var integer $toAdsl
     *
     *      @ORM\Column(name="TO_ADSL", type="integer")
     */
    private $toAdsl;

    /**
     *
     * @var integer $toZsmart
     *
     *      @ORM\Column(name="TO_ZSMART", type="integer")
     */
    private $toZsmart;

    /**
     *
     * @var integer $readOnly
     *
     *      @ORM\Column(name="READONLY", type="integer")
     */
    private $readOnly;

    /**
     *
     * @var integer $delaiEnvoiSmsDateFin
     *
     *      @ORM\Column(name="DELAI_ENVOI_SMS_DATE_FIN", type="integer")
     */
    private $delaiEnvoiSmsDateFin;

    /**
     *
     * @var integer $idSmsSortantDelaiFinOption
     *
     *      @ORM\Column(name="ID_SMS_SORTANT_DELAI_FIN_OPTION", type="integer")
     */
    private $idSmsSortantDelaiFinOption;
    
    

    /**
     * @return the $optionsClient
     */
    public function getOptionsClient()
    {
        return $this->optionsClient;
    }

    /**
     * @param field_type $optionsClient
     */
    public function setOptionsClient($optionsClient)
    {
        $this->optionsClient = $optionsClient;
    }

    /**
     * @return the $diseService
     */
    public function getDiseService()
    {
        return $this->diseService;
    }

    /**
     * @param integer $diseService
     */
    public function setDiseService($diseService)
    {
        $this->diseService = $diseService;
    }

    /**
     *
     * @return the $article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     *
     * @return Options $options
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     *
     * @param integer $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     *
     * @param Options $options
     */
    public function setOption($option)
    {
        $this->option = $option;
    }

    /**
     *
     * @return the $idForfaitOption
     */
    public function getIdForfaitOption()
    {
        return $this->idForfaitOption;
    }

    /**
     *
     * @return the $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     *
     * @return the $idOption
     */
    public function getIdOption()
    {
        return $this->idOption;
    }

    /**
     *
     * @return the $inclus
     */
    public function getInclus()
    {
        return $this->inclus;
    }

    /**
     *
     * @return the $gratuit
     */
    public function getGratuit()
    {
        return $this->gratuit;
    }

    /**
     *
     * @return the $idFormuleOpt
     */
    public function getIdFormuleOpt()
    {
        return $this->idFormuleOpt;
    }

    /**
     *
     * @return the $actif
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     *
     * @return the $toSachem
     */
    public function getToSachem()
    {
        return $this->toSachem;
    }

    /**
     *
     * @return the $toDise
     */
    public function getToDise()
    {
        return $this->toDise;
    }

    /**
     *
     * @return the $toOmd
     */
    public function getToOmd()
    {
        return $this->toOmd;
    }

    /**
     *
     * @return the $toAdsl
     */
    public function getToAdsl()
    {
        return $this->toAdsl;
    }

    /**
     *
     * @return the $toZsmart
     */
    public function getToZsmart()
    {
        return $this->toZsmart;
    }

    /**
     *
     * @return the $readOnly
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }

    /**
     *
     * @return the $delaiEnvoiSmsDateFin
     */
    public function getDelaiEnvoiSmsDateFin()
    {
        return $this->delaiEnvoiSmsDateFin;
    }

    /**
     *
     * @return the $idSmsSortantDelaiFinOption
     */
    public function getIdSmsSortantDelaiFinOption()
    {
        return $this->idSmsSortantDelaiFinOption;
    }

    /**
     *
     * @param integer $idForfaitOption
     */
    public function setIdForfaitOption($idForfaitOption)
    {
        $this->idForfaitOption = $idForfaitOption;
    }

    /**
     *
     * @param integer $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

    /**
     *
     * @param integer $idOption
     */
    public function setIdOption($idOption)
    {
        $this->idOption = $idOption;
    }

    /**
     *
     * @param date $inclus
     */
    public function setInclus($inclus)
    {
        $this->inclus = $inclus;
    }

    /**
     *
     * @param date $gratuit
     */
    public function setGratuit($gratuit)
    {
        $this->gratuit = $gratuit;
    }

    /**
     *
     * @param date $idFormuleOpt
     */
    public function setIdFormuleOpt($idFormuleOpt)
    {
        $this->idFormuleOpt = $idFormuleOpt;
    }

    /**
     *
     * @param date $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     *
     * @param date $toSachem
     */
    public function setToSachem($toSachem)
    {
        $this->toSachem = $toSachem;
    }

    /**
     *
     * @param date $toDise
     */
    public function setToDise($toDise)
    {
        $this->toDise = $toDise;
    }

    /**
     *
     * @param date $toOmd
     */
    public function setToOmd($toOmd)
    {
        $this->toOmd = $toOmd;
    }

    /**
     *
     * @param date $toAdsl
     */
    public function setToAdsl($toAdsl)
    {
        $this->toAdsl = $toAdsl;
    }

    /**
     *
     * @param date $toZsmart
     */
    public function setToZsmart($toZsmart)
    {
        $this->toZsmart = $toZsmart;
    }

    /**
     *
     * @param date $readOnly
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;
    }

    /**
     *
     * @param date $delaiEnvoiSmsDateFin
     */
    public function setDelaiEnvoiSmsDateFin($delaiEnvoiSmsDateFin)
    {
        $this->delaiEnvoiSmsDateFin = $delaiEnvoiSmsDateFin;
    }

    /**
     *
     * @param date $idSmsSortantDelaiFinOption
     */
    public function setIdSmsSortantDelaiFinOption($idSmsSortantDelaiFinOption)
    {
        $this->idSmsSortantDelaiFinOption = $idSmsSortantDelaiFinOption;
    }
}
