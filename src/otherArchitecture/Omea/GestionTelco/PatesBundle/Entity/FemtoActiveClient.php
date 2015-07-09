<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoActiveClient
 *
 * @ORM\Table(name="FEMTO_ACTIVE_CLIENT")
 * @ORM\Entity(repositoryClass="Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientRepository")
 */
class FemtoActiveClient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FAC_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $facId;

    /**
     * @var \FemtoActiveClientState
     *
     * @ORM\ManyToOne(targetEntity="FemtoActiveClientState")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="STATE_ID", referencedColumnName="FACS_ID")
     * })
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUM_ABO", type="integer", nullable=false)
     */
    private $numAbo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ACTIVE_AT", type="datetime", nullable=true)
     */
    private $activeAt;

    /**
     * @var \FemtoStock
     *
     * @ORM\ManyToOne(targetEntity="FemtoStock")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IMEI", referencedColumnName="IMEI")
     * })
     */
    private $imei;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="FemtoMsisdn", mappedBy="fac")
     */
    private $msisdns;

    public function __construct()
    {
        $this->msisdns = new ArrayCollection();
    }

    /**
     * Get facId
     *
     * @return integer 
     */
    public function getFacId()
    {
        return $this->facId;
    }

    /**
     * Set state
     *
     * @param \Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState $state
     * @return FemtoActiveClient
     */
    public function setState(\Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set numAbo
     *
     * @param integer $numAbo
     * @return FemtoActiveClient
     */
    public function setNumAbo($numAbo)
    {
        $this->numAbo = $numAbo;

        return $this;
    }

    /**
     * Get numAbo
     *
     * @return integer 
     */
    public function getNumAbo()
    {
        return $this->numAbo;
    }

    /**
     * Set activeAt
     *
     * @param \DateTime $activeAt
     * @return FemtoActiveClient
     */
    public function setActiveAt($activeAt)
    {
        $this->activeAt = $activeAt;

        return $this;
    }

    /**
     * Get activeAt
     *
     * @return \DateTime 
     */
    public function getActiveAt()
    {
        return $this->activeAt;
    }

    /**
     * Set imei
     *
     * @param \Omea\GestionTelco\PatesBundle\Entity\FemtoStock $imei
     * @return FemtoActiveClient
     */
    public function setImei(\Omea\GestionTelco\PatesBundle\Entity\FemtoStock $imei = null)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoStock 
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Get msisdns
     *
     * @return ArrayCollection
     */
    public function getMsisdns()
    {
        return $this->msisdns;
    }
}
