<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FLUIDITE_INTERNET_ERROR")
 * @ORM\Entity
 */
class FluiditeInternetError
{

    /**
     *      @ORM\Column(name="ID_FLUIDITE_INTERNET_ERROR", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idFluiditeInternetError;

    /**
     *      @ORM\Column(name="ID_FLUIDITE_INTERNET", type="integer")
     */
    private $idFluiditeInternet;

    /**
     *      @ORM\Column(name="ORIGINE", type="string")
     */
    private $origine;

    /**
     *      @ORM\Column(name="ERROR", type="string")
     */
    private $error;

    /**
     *      @ORM\Column(name="DATE_ERROR", type="datetime")
     */
    private $dateError;
    
    /**
     * @ORM\ManyToOne(targetEntity="FluiditeInternet", inversedBy="fluiditeInternetError")
     * @ORM\JoinColumn(name="ID_FLUIDITE_INTERNET", referencedColumnName="ID_FLUIDITE_INTERNET")
     */
    private $fluiditeInternet;
    
	/**
     * @return the $fluiditeInternet
     */
    public function getFluiditeInternet()
    {
        return $this->fluiditeInternet;
    }

	/**
     * @param field_type $fluiditeInternet
     */
    public function setFluiditeInternet($fluiditeInternet)
    {
        $this->fluiditeInternet = $fluiditeInternet;
    }

	/**
     * @return the $idFluiditeInternetError
     */
    public function getIdFluiditeInternetError()
    {
        return $this->idFluiditeInternetError;
    }

	/**
     * @return the $idFluiditeInternet
     */
    public function getIdFluiditeInternet()
    {
        return $this->idFluiditeInternet;
    }

	/**
     * @return the $origine
     */
    public function getOrigine()
    {
        return $this->origine;
    }

	/**
     * @return the $error
     */
    public function getError()
    {
        return $this->error;
    }

	/**
     * @return the $dateError
     */
    public function getDateError()
    {
        return $this->dateError;
    }

	/**
     * @param field_type $idFluiditeInternetError
     */
    public function setIdFluiditeInternetError($idFluiditeInternetError)
    {
        $this->idFluiditeInternetError = $idFluiditeInternetError;
    }

	/**
     * @param field_type $idFluiditeInternet
     */
    public function setIdFluiditeInternet($idFluiditeInternet)
    {
        $this->idFluiditeInternet = $idFluiditeInternet;
    }

	/**
     * @param field_type $origine
     */
    public function setOrigine($origine)
    {
        $this->origine = $origine;
    }

	/**
     * @param field_type $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

	/**
     * @param field_type $dateError
     */
    public function setDateError($dateError)
    {
        $this->dateError = $dateError;
    }



}
