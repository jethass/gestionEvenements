<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="PASS")
 * @ORM\Entity
 */
class Pass
{

    /**
     *
     * @var integer $idPass
     *      @ORM\Column(name="ID_PASS", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPass;

    /**
     *
     * @var string $idOption
     *
     *      @ORM\Column(name="ID_OPTION", type="integer")
     */
    private $idOption;

    /**
     * @ORM\ManyToOne(targetEntity="Options", inversedBy="pass")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION")
     */
    private $option;

    /**
     *
     * @var $diseService
     *      @ORM\ManyToOne(targetEntity="DiseService", inversedBy="pass")
     *      @ORM\JoinColumn(name="TO_OMD", referencedColumnName = "ID_DS")
     */
    private $diseService;

    /**
     *
     * @var string $label
     *
     *      @ORM\Column(name="LABEL", type="string" , length=50)
     */
    private $label;

    /**
     *
     * @var string $jusqueRaz
     *
     *      @ORM\Column(name="JUSQUE_RAZ", type="integer")
     */
    private $jusqueRaz;

    /**
     *
     * @var integet $dlv
     *
     *      @ORM\Column(name="DLV", type="integer")
     */
    private $dlv;

    /**
     *
     * @var integer $cumulMax
     *
     *      @ORM\Column(name="CUMUL_MAX", type="integer")
     */
    private $cumulMax;

    /**
     *
     * @var integer $optionEquiv
     *
     *      @ORM\Column(name="OPTION_EQUIV", type="integer")
     */
    private $optionEquiv;

    /**
     * @ORM\OneToOne(targetEntity="Options")
     * @ORM\JoinColumn(name="OPTION_EQUIV", referencedColumnName="ID_OPTION")
     */
    private $optionEquivalent;

    /**
     *
     * @var string $toOmd
     *
     *      @ORM\Column(name="To_OMD", type="string")
     */
    private $toOmd;

    /**
     *
     * @var integer $toZsmart
     *
     *      @ORM\Column(name="TO_ZSMART", type="integer")
     */
    private $toZsmart;

    /**
     *
     * @var integer $idEvent
     *
     *      @ORM\Column(name="ID_EVENT", type="integer")
     */
    private $idEvent;

    /**
     *
     * @var integer $smsOk
     *
     *      @ORM\Column(name="SMS_OK", type="string")
     */
    private $smsOk;

    /**
     *
     * @var integer $smsKo
     *
     *      @ORM\Column(name="SMS_KO", type="string")
     */
    private $smsKo;

    /**
     * @return the $optionEquiv
     */
    public function getOptionEquiv()
    {
        return $this->optionEquiv;
    }

    /**
     * @return the $optionEquivalent
     */
    public function getOptionEquivalent()
    {
        return $this->optionEquivalent;
    }

    /**
     * @param number $optionEquiv
     */
    public function setOptionEquiv($optionEquiv)
    {
        $this->optionEquiv = $optionEquiv;
    }

    /**
     * @param field_type $optionEquivalent
     */
    public function setOptionEquivalent($optionEquivalent)
    {
        $this->optionEquivalent = $optionEquivalent;
    }

    /**
     * @return the $diseService
     */
    public function getDiseService()
    {
        return $this->diseService;
    }

    /**
     * @param $diseService $diseService
     */
    public function setDiseService($diseService)
    {
        $this->diseService = $diseService;
    }

    /**
     * @return the $option
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @return the $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param field_type $option
     */
    public function setOption($option)
    {
        $this->option = $option;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return the $idPass
     */
    public function getIdPass()
    {
        return $this->idPass;
    }

    /**
     * @return the $idOption
     */
    public function getIdOption()
    {
        return $this->idOption;
    }

    /**
     * @return the $titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return the $jusqueRaz
     */
    public function getJusqueRaz()
    {
        return $this->jusqueRaz;
    }

    /**
     * @return the $dlv
     */
    public function getDlv()
    {
        return $this->dlv;
    }

    /**
     * @return the $cumulMax
     */
    public function getCumulMax()
    {
        return $this->cumulMax;
    }

    /**
     * @return the $toOmd
     */
    public function getToOmd()
    {
        return $this->toOmd;
    }

    /**
     * @return the $toZsmart
     */
    public function getToZsmart()
    {
        return $this->toZsmart;
    }

    /**
     * @return the $idEvent
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * @return the $smsOk
     */
    public function getSmsOk()
    {
        return $this->smsOk;
    }

    /**
     * @return the $smsKo
     */
    public function getSmsKo()
    {
        return $this->smsKo;
    }

    /**
     * @param integer $idPass
     */
    public function setIdPass($idPass)
    {
        $this->idPass = $idPass;
    }

    /**
     * @param string $idOption
     */
    public function setIdOption($idOption)
    {
        $this->idOption = $idOption;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @param string $jusqueRaz
     */
    public function setJusqueRaz($jusqueRaz)
    {
        $this->jusqueRaz = $jusqueRaz;
    }

    /**
     * @param integet $dlv
     */
    public function setDlv($dlv)
    {
        $this->dlv = $dlv;
    }

    /**
     * @param float $cumulMax
     */
    public function setCumulMax($cumulMax)
    {
        $this->cumulMax = $cumulMax;
    }

    /**
     * @param integer $toOmd
     */
    public function setToOmd($toOmd)
    {
        $this->toOmd = $toOmd;
    }

    /**
     * @param integer $toZsmart
     */
    public function setToZsmart($toZsmart)
    {
        $this->toZsmart = $toZsmart;
    }

    /**
     * @param integer $idEvent
     */
    public function setIdEvent($idEvent)
    {
        $this->idEvent = $idEvent;
    }

    /**
     * @param integer $smsOk
     */
    public function setSmsOk($smsOk)
    {
        $this->smsOk = $smsOk;
    }

    /**
     * @param integer $smsKo
     */
    public function setSmsKo($smsKo)
    {
        $this->smsKo = $smsKo;
    }

}
