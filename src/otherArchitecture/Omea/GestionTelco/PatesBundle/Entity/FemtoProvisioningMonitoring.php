<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoProvisioningMonitoring
 *
 * @ORM\Table(name="FEMTO_PROVISIONING_MONITORING")
 * @ORM\Entity(repositoryClass="Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringRepository")
 */
class FemtoProvisioningMonitoring
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FEMTO_MON_ID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $femtoMonId;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUM_ABO", type="integer", nullable=true)
     */
    private $numAbo;

    /**
     * @var integer
     *
     * @ORM\Column(name="MSISDN", type="string", nullable=true)
     */
    private $msisdn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_DEMANDE", type="datetime", nullable=false)
     */
    private $dateDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_TRAITEMENT", type="datetime", nullable=true)
     */
    private $dateTraitement;

    /**
     * @var string
     *
     * @ORM\Column(name="COMPLEMENT", type="string", length=255, nullable=true)
     */
    private $complement;

    /**
     * @var integer
     *
     * @ORM\Column(name="CODE_RETOUR", type="integer", nullable=true)
     */
    private $codeRetour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="SEND_AT", type="datetime", nullable=true)
     */
    private $sendAt;

    /**
     * @var \FemtoProvisioningMonitoringAction
     *
     * @ORM\ManyToOne(targetEntity="FemtoProvisioningMonitoringAction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TYPE_ACTION_ID", referencedColumnName="TYPE_ACTION_ID")
     * })
     */
    private $typeAction;

    /**
     * @var \FemtoProvisioningMonitoringStep
     *
     * @ORM\ManyToOne(targetEntity="FemtoProvisioningMonitoringStep")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="STEP_ID", referencedColumnName="STEP_ID")
     * })
     */
    private $step;


    public function __construct()
    {
        $this->dateDemande = new \DateTime();
    }

    /**
     * Get femtoMonId
     *
     * @return integer 
     */
    public function getFemtoMonId()
    {
        return $this->femtoMonId;
    }

    /**
     * Set numAbo
     *
     * @param integer $numAbo
     * @return FemtoProvisioningMonitoring
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
     * Set msisdn
     *
     * @param integer $msisdn
     * @return FemtoProvisioningMonitoring
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
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     * @return FemtoProvisioningMonitoring
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;
    
        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime 
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set dateTraitement
     *
     * @param \DateTime $dateTraitement
     * @return FemtoProvisioningMonitoring
     */
    public function setDateTraitement($dateTraitement)
    {
        $this->dateTraitement = $dateTraitement;
    
        return $this;
    }

    /**
     * Get dateTraitement
     *
     * @return \DateTime 
     */
    public function getDateTraitement()
    {
        return $this->dateTraitement;
    }

    /**
     * Set complement
     *
     * @param string $complement
     * @return FemtoProvisioningMonitoring
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
    
        return $this;
    }

    /**
     * Get complement
     *
     * @return string 
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * Set codeRetour
     *
     * @param integer $codeRetour
     * @return FemtoProvisioningMonitoring
     */
    public function setCodeRetour($codeRetour)
    {
        $this->codeRetour = $codeRetour;
    
        return $this;
    }

    /**
     * Get codeRetour
     *
     * @return integer 
     */
    public function getCodeRetour()
    {
        return $this->codeRetour;
    }

    /**
     * Set sendAt
     *
     * @param \DateTime $sendAt
     * @return FemtoProvisioningMonitoring
     */
    public function setSendAt($sendAt)
    {
        $this->sendAt = $sendAt;
    
        return $this;
    }

    /**
     * Get sendAt
     *
     * @return \DateTime 
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * Set typeAction
     *
     * @param \Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringAction $typeAction
     * @return FemtoProvisioningMonitoring
     */
    public function setTypeAction(FemtoProvisioningMonitoringAction $typeAction = null)
    {
        $this->typeAction = $typeAction;
    
        return $this;
    }

    /**
     * Get typeAction
     *
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringAction 
     */
    public function getTypeAction()
    {
        return $this->typeAction;
    }

    /**
     * Set step
     *
     * @param \Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringStep $step
     * @return FemtoProvisioningMonitoring
     */
    public function setStep(FemtoProvisioningMonitoringStep $step = null)
    {
        $this->step = $step;
    
        return $this;
    }

    /**
     * Get step
     *
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringStep 
     */
    public function getStep()
    {
        return $this->step;
    }
}
