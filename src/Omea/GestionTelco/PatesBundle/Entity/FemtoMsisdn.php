<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoMsisdn
 *
 * @ORM\Table(name="FEMTO_MSISDN")
 * @ORM\Entity(repositoryClass="Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnRepository")
 */
class FemtoMsisdn
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FML_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fmlId;

    /**
     * @var integer
     *
     * @ORM\Column(name="MSISDN", type="string", nullable=true, columnDefinition="UNSIGNED INTEGER(10) ZEROFILL")
     */
    private $msisdn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_DEBUT", type="datetime", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_FIN", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="IMSI", type="string", length=45, nullable=true)
     */
    private $imsi;

    /**
     * @var \FemtoMsisdnState
     *
     * @ORM\ManyToOne(targetEntity="FemtoMsisdnState")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="STATE_ID", referencedColumnName="FMS_ID")
     * })
     */
    private $state;

    /**
     * @var \FemtoActiveClient
     *
     * @ORM\ManyToOne(targetEntity="FemtoActiveClient", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FAC_ID", referencedColumnName="FAC_ID")
     * })
     */
    private $fac;



    /**
     * Get fmlId
     *
     * @return integer 
     */
    public function getFmlId()
    {
        return $this->fmlId;
    }

    /**
     * Set msisdn
     *
     * @param integer $msisdn
     * @return FemtoMsisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    
        return $this;
    }

    /**
     * Get msisdn
     *
     * @return integer 
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return FemtoMsisdn
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return FemtoMsisdn
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set imsi
     *
     * @param string $imsi
     * @return FemtoMsisdn
     */
    public function setImsi($imsi)
    {
        $this->imsi = $imsi;
    
        return $this;
    }

    /**
     * Get imsi
     *
     * @return string 
     */
    public function getImsi()
    {
        return $this->imsi;
    }

    /**
     * Set state
     *
     * @param \Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState $state
     * @return FemtoMsisdn
     */
    public function setState(\Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState $state = null)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set fac
     *
     * @param \Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClient $fac
     * @return FemtoMsisdn
     */
    public function setFac(\Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClient $fac = null)
    {
        $this->fac = $fac;
    
        return $this;
    }

    /**
     * Get fac
     *
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClient 
     */
    public function getFac()
    {
        return $this->fac;
    }
}
