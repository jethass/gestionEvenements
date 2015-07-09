<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OPTIONS")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\OptionsRepository")
 */
class Options
{

    /**
     *
     * @var integer $idOption
     *      @ORM\Column(name="ID_OPTION", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOption;

    /**
     *
     * @var string $typeOption
     *
     *      @ORM\Column(name="TYPE_OPTION", type="string")
     */
    private $typeOption;

    /**
     *
     * @var string $labelCourt
     *
     *      @ORM\Column(name="LABEL_COURT", type="string" , length=255)
     */
    private $labelCourt;

    /**
     *
     * @var string $labelLong
     *
     *      @ORM\Column(name="LABEL_LONG", type="string" , length=255)
     */
    private $labelLong;

    /**
     *
     * @var integet $engagement
     *
     *      @ORM\Column(name="ENGAGEMENT", type="string")
     */
    private $engagement;

    /**
     *
     * @var integet $dlv
     *
     *      @ORM\Column(name="DLV", type="string")
     */
    private $dlv;

    /**
     *
     * @var float $tarif
     *
     *      @ORM\Column(name="TARIF", type="float")
     */
    private $tarif;

    /**
     *
     * @var integer $idEvtAdd
     *
     *      @ORM\Column(name="ID_EVT_ADD", type="integer")
     */
    private $idEvtAdd;

    /**
     *
     * @var integer $idEvtDelete
     *
     *      @ORM\Column(name="ID_EVT_DELETE", type="integer")
     */
    private $idEvtDelete;

    /**
     *
     * @var integer $idEvtKo
     *
     *      @ORM\Column(name="ID_EVT_KO", type="integer")
     */
    private $idEvtKo;

    /**
     *
     * @var integer $idMsgEcareAdd
     *
     *      @ORM\Column(name="ID_MSG_ECARE_ADD", type="integer")
     */
    private $idMsgEcareAdd;

    /**
     *
     * @var integer $idMsgEcareDelete
     *
     *      @ORM\Column(name="ID_MSG_ECARE_DELETE", type="integer")
     */
    private $idMsgEcareDelete;

    /**
     *
     * @var integer $smsSortantId
     *
     *      @ORM\Column(name="SMS_SORTANT_ID", type="integer")
     */
    private $smsSortantId;

    /**
     *
     * @var integer $idElement
     *
     *      @ORM\Column(name="ID_ELEMENT", type="integer")
     */
    private $idElement;

    /**
     *
     * @var integer $idOptParent
     *
     *      @ORM\Column(name="ID_OPT_PARENT", type="integer")
     */
    private $idOptParent;

    /**
     *
     * @var integer $dateCreate
     *
     *      @ORM\Column(name="DATE_CREATE", type="datetime")
     */
    private $dateCreate;

    /**
     * @ORM\OneToMany(targetEntity="Pass", mappedBy="option")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION")
     */
    private $pass;

    /**
    * @ORM\OneToMany(targetEntity="OptionsGroupes", mappedBy="optionFairuseBase")
    * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION_FAIRUSE_BASE")
    */
    private $optionsGroupesBase;

    /**
     * @ORM\OneToMany(targetEntity="OptionsGroupes", mappedBy="optionFairuseRoaming")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION_ROAMING_BASE")
     */
    private $optionsGroupesRoaming;

    /**
     * @ORM\OneToMany(targetEntity="OptionsGroupes", mappedBy="options")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION")
     */
    private $optionsGroupes;

    /**
     *
     * @var $forfaitOptions
     *      @ORM\OneToMany(targetEntity="ForfaitOptions", mappedBy="option")
     *      @ORM\JoinColumn(name="ID_OPTION", referencedColumnName = "ID_OPTION")
     */
    private $forfaitOptions;
    
    /**
     * @ORM\OneToMany(targetEntity="OptionIncompatible", mappedBy="options1")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName = "ID_DS1")
     */
    private $optionsIncompatible1;
    
    /**
     * @ORM\OneToMany(targetEntity="OptionIncompatible", mappedBy="options2")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName = "ID_DS2")
     */
    private $optionsIncompatible2;
    
    /**
     * @ORM\OneToMany(targetEntity="FluiditeInternetOptions", mappedBy="options")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION")
     */
    private $fluiditeInternetOptions;

    /**
     * @return the $optionsIncompatible1
     */
    public function getOptionsIncompatible1()
    {
        return $this->optionsIncompatible1;
    }

	/**
     * @return the $optionsIncompatible2
     */
    public function getOptionsIncompatible2()
    {
        return $this->optionsIncompatible2;
    }

	/**
     * @return the $fluiditeInternetOptions
     */
    public function getFluiditeInternetOptions()
    {
        return $this->fluiditeInternetOptions;
    }

	/**
     * @param field_type $optionsIncompatible1
     */
    public function setOptionsIncompatible1($optionsIncompatible1)
    {
        $this->optionsIncompatible1 = $optionsIncompatible1;
    }

	/**
     * @param field_type $optionsIncompatible2
     */
    public function setOptionsIncompatible2($optionsIncompatible2)
    {
        $this->optionsIncompatible2 = $optionsIncompatible2;
    }

	/**
     * @param field_type $fluiditeInternetOptions
     */
    public function setFluiditeInternetOptions($fluiditeInternetOptions)
    {
        $this->fluiditeInternetOptions = $fluiditeInternetOptions;
    }

	/**
     * @return the $optionsGroupesRoaming
     */
    public function getOptionsGroupesRoaming()
    {
        return $this->optionsGroupesRoaming;
    }

    /**
     * @param field_type $optionsGroupesRoaming
     */
    public function setOptionsGroupesRoaming($optionsGroupesRoaming)
    {
        $this->optionsGroupesRoaming = $optionsGroupesRoaming;
    }

    /**
     * @return the $optionsGroupesBase
     */
    public function getOptionsGroupesBase()
    {
        return $this->optionsGroupesBase;
    }

    /**
     * @return the $optionsGroupes
     */
    public function getOptionsGroupes()
    {
        return $this->optionsGroupes;
    }

    /**
     * @return the $forfaitOptions
     */
    public function getForfaitOptions()
    {
        return $this->forfaitOptions;
    }

    /**
     * @param field_type $optionsGroupesBase
     */
    public function setOptionsGroupesBase($optionsGroupesBase)
    {
        $this->optionsGroupesBase = $optionsGroupesBase;
    }

    /**
     * @param field_type $optionsGroupes
     */
    public function setOptionsGroupes($optionsGroupes)
    {
        $this->optionsGroupes = $optionsGroupes;
    }

    /**
     * @param \Omea\Entity\Main\$forfaitOptions $forfaitOptions
     */
    public function setForfaitOptions($forfaitOptions)
    {
        $this->forfaitOptions = $forfaitOptions;
    }

    /**
     * @return the $pass
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param field_type $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
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
     * @return the $typeOption
     */
    public function getTypeOption()
    {
        return $this->typeOption;
    }

    /**
     *
     * @return the $labelCourt
     */
    public function getLabelCourt()
    {
        return $this->labelCourt;
    }

    /**
     *
     * @return the $labelLong
     */
    public function getLabelLong()
    {
        return $this->labelLong;
    }

    /**
     *
     * @return the $engagement
     */
    public function getEngagement()
    {
        return $this->engagement;
    }

    /**
     *
     * @return the $dlv
     */
    public function getDlv()
    {
        return $this->dlv;
    }

    /**
     *
     * @return the $tarif
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     *
     * @return the $idEvtAdd
     */
    public function getIdEvtAdd()
    {
        return $this->idEvtAdd;
    }

    /**
     *
     * @return the $idEvtDelete
     */
    public function getIdEvtDelete()
    {
        return $this->idEvtDelete;
    }

    /**
     *
     * @return the $idEvtKo
     */
    public function getIdEvtKo()
    {
        return $this->idEvtKo;
    }

    /**
     *
     * @return the $idMsgEcareAdd
     */
    public function getIdMsgEcareAdd()
    {
        return $this->idMsgEcareAdd;
    }

    /**
     *
     * @return the $idMsgEcareDelete
     */
    public function getIdMsgEcareDelete()
    {
        return $this->idMsgEcareDelete;
    }

    /**
     *
     * @return the $smsSortantId
     */
    public function getSmsSortantId()
    {
        return $this->smsSortantId;
    }

    /**
     *
     * @return the $idElement
     */
    public function getIdElement()
    {
        return $this->idElement;
    }

    /**
     *
     * @return the $idOptParent
     */
    public function getIdOptParent()
    {
        return $this->idOptParent;
    }

    /**
     *
     * @return the $dateCreate
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
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
     * @param string $typeOption
     */
    public function setTypeOption($typeOption)
    {
        $this->typeOption = $typeOption;
    }

    /**
     *
     * @param string $labelCourt
     */
    public function setLabelCourt($labelCourt)
    {
        $this->labelCourt = $labelCourt;
    }

    /**
     *
     * @param string $labelLong
     */
    public function setLabelLong($labelLong)
    {
        $this->labelLong = $labelLong;
    }

    /**
     *
     * @param integet $engagement
     */
    public function setEngagement($engagement)
    {
        $this->engagement = $engagement;
    }

    /**
     *
     * @param integet $dlv
     */
    public function setDlv($dlv)
    {
        $this->dlv = $dlv;
    }

    /**
     *
     * @param float $tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     *
     * @param integer $idEvtAdd
     */
    public function setIdEvtAdd($idEvtAdd)
    {
        $this->idEvtAdd = $idEvtAdd;
    }

    /**
     *
     * @param integer $idEvtDelete
     */
    public function setIdEvtDelete($idEvtDelete)
    {
        $this->idEvtDelete = $idEvtDelete;
    }

    /**
     *
     * @param integer $idEvtKo
     */
    public function setIdEvtKo($idEvtKo)
    {
        $this->idEvtKo = $idEvtKo;
    }

    /**
     *
     * @param integer $idMsgEcareAdd
     */
    public function setIdMsgEcareAdd($idMsgEcareAdd)
    {
        $this->idMsgEcareAdd = $idMsgEcareAdd;
    }

    /**
     *
     * @param integer $idMsgEcareDelete
     */
    public function setIdMsgEcareDelete($idMsgEcareDelete)
    {
        $this->idMsgEcareDelete = $idMsgEcareDelete;
    }

    /**
     *
     * @param integer $smsSortantId
     */
    public function setSmsSortantId($smsSortantId)
    {
        $this->smsSortantId = $smsSortantId;
    }

    /**
     *
     * @param integer $idElement
     */
    public function setIdElement($idElement)
    {
        $this->idElement = $idElement;
    }

    /**
     *
     * @param integer $idOptParent
     */
    public function setIdOptParent($idOptParent)
    {
        $this->idOptParent = $idOptParent;
    }

    /**
     *
     * @param integer $dateCreate
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
    }
}
