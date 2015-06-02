<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoStock
 *
 * @ORM\Table(name="FEMTO_STOCK")
 * @ORM\Entity
 */
class FemtoStock
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IMEI", type="string", nullable=false)
     * @ORM\Id
     */
    private $imei;

    /**
     * @var string
     *
     * @ORM\Column(name="ADRESSE_MAC", type="string", length=45, nullable=false)
     */
    private $adresseMac;

    /**
     * @var string
     *
     * @ORM\Column(name="MANUFACTURER", type="string", length=45, nullable=false)
     */
    private $manufacturer;

    /**
     * @var string
     *
     * @ORM\Column(name="OUI", type="string", length=45, nullable=true)
     */
    private $oui;

    /**
     * @var string
     *
     * @ORM\Column(name="PRODUCT_CLASS", type="string", length=45, nullable=true)
     */
    private $productClass;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_IMPORT", type="datetime", nullable=false)
     */
    private $dateImport;

    public function __construct()
    {
        $this->dateImport = new \DateTime();
    }

    /**
     * Set imei
     *
     * @param integer $imei
     * @return FemtoStock
     */
    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return integer 
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set adresseMac
     *
     * @param string $adresseMac
     * @return FemtoStock
     */
    public function setAdresseMac($adresseMac)
    {
        $this->adresseMac = $adresseMac;

        return $this;
    }

    /**
     * Get adresseMac
     *
     * @return string 
     */
    public function getAdresseMac()
    {
        return $this->adresseMac;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return FemtoStock
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set oui
     *
     * @param string $oui
     * @return FemtoStock
     */
    public function setOui($oui)
    {
        $this->oui = $oui;

        return $this;
    }

    /**
     * Get oui
     *
     * @return string 
     */
    public function getOui()
    {
        return $this->oui;
    }

    /**
     * Set productClass
     *
     * @param string $productClass
     * @return FemtoStock
     */
    public function setProductClass($productClass)
    {
        $this->productClass = $productClass;

        return $this;
    }

    /**
     * Get productClass
     *
     * @return string 
     */
    public function getProductClass()
    {
        return $this->productClass;
    }

    /**
     * Set dateImport
     *
     * @param \DateTime $dateImport
     * @return FemtoStock
     */
    public function setDateImport($dateImport)
    {
        $this->dateImport = $dateImport;

        return $this;
    }

    /**
     * Get dateImport
     *
     * @return \DateTime 
     */
    public function getDateImport()
    {
        return $this->dateImport;
    }
}
