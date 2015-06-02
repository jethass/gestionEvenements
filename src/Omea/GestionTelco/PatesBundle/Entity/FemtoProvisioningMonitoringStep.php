<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoProvisioningMonitoringStep
 *
 * @ORM\Table(name="FEMTO_PROVISIONING_MONITORING_STEP")
 * @ORM\Entity
 */
class FemtoProvisioningMonitoringStep
{
    const START = 1;
    const CHECK_PARAMS = 2;
    const PENDING = 3;
    const CALL_GATEWAY = 4;
    const END = 5;

    /**
     * @var integer
     *
     * @ORM\Column(name="STEP_ID", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $stepId;

    /**
     * @var string
     *
     * @ORM\Column(name="STEP", type="string", length=50, nullable=false)
     */
    private $step;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=300, nullable=false)
     */
    private $description;



    /**
     * Get stepId
     *
     * @return integer 
     */
    public function getStepId()
    {
        return $this->stepId;
    }

    /**
     * Set step
     *
     * @param string $step
     * @return FemtoProvisioningMonitoringStep
     */
    public function setStep($step)
    {
        $this->step = $step;
    
        return $this;
    }

    /**
     * Get step
     *
     * @return string 
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return FemtoProvisioningMonitoringStep
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
