<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FLUIDITE_INTERNET_OPTIONS")
 * @ORM\Entity
 */
class FluiditeInternetOptions
{

    /**
     *      @ORM\Column(name="ID_FLUIDITE_INTERNET_OPTIONS", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFluiditeInternetOptions;

    /**
     *      @ORM\Column(name="ID_FLUIDITE_INTERNET", type="integer")
     */
    private $idFluiditeInternet;

    /**
     *      @ORM\Column(name="ID_OPTION", type="integer")
     */
    private $idOption;

    /**
     * @ORM\ManyToOne(targetEntity="FluiditeInternet", inversedBy="fluiditeInternetOptions")
     * @ORM\JoinColumn(name="ID_FLUIDITE_INTERNET", referencedColumnName="ID_FLUIDITE_INTERNET")
     */
    private $fluiditeInternet;

    /**
     * @ORM\OneToOne(targetEntity="Options", mappedBy="fluiditeInternetOptions")
     * @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION")
     */
    private $options;

	/**
     * @return the $idFluiditeInternetOptions
     */
    public function getIdFluiditeInternetOptions()
    {
        return $this->idFluiditeInternetOptions;
    }

	/**
     * @return the $idFluiditeInternet
     */
    public function getIdFluiditeInternet()
    {
        return $this->idFluiditeInternet;
    }

	/**
     * @return the $idOption
     */
    public function getIdOption()
    {
        return $this->idOption;
    }

	/**
     * @return the $fluiditeInternet
     */
    public function getFluiditeInternet()
    {
        return $this->fluiditeInternet;
    }

	/**
     * @return Options $options
     */
    public function getOptions()
    {
        return $this->options;
    }

	/**
     * @param field_type $idFluiditeInternetOptions
     */
    public function setIdFluiditeInternetOptions($idFluiditeInternetOptions)
    {
        $this->idFluiditeInternetOptions = $idFluiditeInternetOptions;
    }

	/**
     * @param field_type $idFluiditeInternet
     */
    public function setIdFluiditeInternet($idFluiditeInternet)
    {
        $this->idFluiditeInternet = $idFluiditeInternet;
    }

	/**
     * @param field_type $idOption
     */
    public function setIdOption($idOption)
    {
        $this->idOption = $idOption;
    }

	/**
     * @param field_type $fluiditeInternet
     */
    public function setFluiditeInternet($fluiditeInternet)
    {
        $this->fluiditeInternet = $fluiditeInternet;
    }

	/**
     * @param field_type $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }


}
