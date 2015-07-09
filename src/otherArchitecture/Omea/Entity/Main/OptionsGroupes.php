<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OPTIONS_GROUPES")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\OptionsGroupesRepository")
 */
class OptionsGroupes
{

    /**
     *
     * @var integer $idOg
     *      @ORM\Column(name="ID_OG", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOg;

    /**
     *
     * @var integer $optionGroup
     *
     *      @ORM\Column(name="OPTION_GROUP", type="integer")
     */
    private $optionGroup;

    /**
     *
     * @var integer $idOptionFairuseBase
     *
     *      @ORM\Column(name="ID_OPTION_FAIRUSE_BASE", type="integer")
     */
    private $idOptionFairuseBase;

    /**
     *
     * @var $options
     *      @ORM\ManyToOne(targetEntity="Options", inversedBy="optionsGroupesBase")
     *      @ORM\JoinColumn(name="ID_OPTION_FAIRUSE_BASE", referencedColumnName = "ID_OPTION")
     */
    private $optionsFairuseBase;

    /**
     *
     * @var integer $idOptionRoamingBase
     *
     *      @ORM\Column(name="ID_OPTION_ROAMING_BASE", type="integer")
     */
    private $idOptionRoamingBase;

    /**
     *
     * @var $options
     *      @ORM\ManyToOne(targetEntity="Options", inversedBy="optionsGroupesRoaming")
     *      @ORM\JoinColumn(name="ID_OPTION_ROAMING_BASE", referencedColumnName = "ID_OPTION")
     */
    private $optionsRoamingBase;

    /**
     *
     * @var integer $hasCockpit
     *
     *      @ORM\Column(name="HAS_COCKPIT", type="integer")
     */
    private $hasCockpit;

    /**
     *
     * @var integer $idOption
     *
     *      @ORM\Column(name="ID_OPTION", type="integer")
     */
    private $idOption;

    /**
     * @return the $idOptionFairuseBase
     */
    public function getIdOptionFairuseBase()
    {
        return $this->idOptionFairuseBase;
    }

    /**
     * @return the $hasCockpit
     */
    public function getHasCockpit()
    {
        return $this->hasCockpit;
    }

    /**
     * @param number $idOptionFairuseBase
     */
    public function setIdOptionFairuseBase($idOptionFairuseBase)
    {
        $this->idOptionFairuseBase = $idOptionFairuseBase;
    }

    /**
     * @return the $idOptionRoamingBase
     */
    public function getIdOptionRoamingBase()
    {
        return $this->idOptionRoamingBase;
    }

    /**
     * @return the $optionsRoamingBase
     */
    public function getOptionsRoamingBase()
    {
        return $this->optionsRoamingBase;
    }

    /**
     * @param number $idOptionRoamingBase
     */
    public function setIdOptionRoamingBase($idOptionRoamingBase)
    {
        $this->idOptionRoamingBase = $idOptionRoamingBase;
    }

    /**
     * @param \Omea\Entity\Main\$options $optionsRoamingBase
     */
    public function setOptionsRoamingBase($optionsRoamingBase)
    {
        $this->optionsRoamingBase = $optionsRoamingBase;
    }

    /**
     * @param number $hasCockpit
     */
    public function setHasCockpit($hasCockpit)
    {
        $this->hasCockpit = $hasCockpit;
    }

    /**
     * @return the $idOg
     */
    public function getIdOg()
    {
        return $this->idOg;
    }

    /**
     * @return the $optionGroup
     */
    public function getOptionGroup()
    {
        return $this->optionGroup;
    }

    /**
     * @return the $idOptinFairuseBase
     */
    public function getIdOptinFairuseBase()
    {
        return $this->idOptinFairuseBase;
    }

    /**
     * @return the $optionsFairuseBase
     */
    public function getOptionsFairuseBase()
    {
        return $this->optionsFairuseBase;
    }

    /**
     * @return the $idOption
     */
    public function getIdOption()
    {
        return $this->idOption;
    }

    /**
     * @param number $idOg
     */
    public function setIdOg($idOg)
    {
        $this->idOg = $idOg;
    }

    /**
     * @param number $optionGroup
     */
    public function setOptionGroup($optionGroup)
    {
        $this->optionGroup = $optionGroup;
    }

    /**
     * @param number $idOptinFairuseBase
     */
    public function setIdOptinFairuseBase($idOptinFairuseBase)
    {
        $this->idOptinFairuseBase = $idOptinFairuseBase;
    }

    /**
     * @param \Omea\Entity\Main\$options $optionsFairuseBase
     */
    public function setOptionsFairuseBase($optionsFairuseBase)
    {
        $this->optionsFairuseBase = $optionsFairuseBase;
    }

    /**
     * @param number $idOption
     */
    public function setIdOption($idOption)
    {
        $this->idOption = $idOption;
    }
}
