<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoProvisioningMonitoringAction
 *
 * @ORM\Table(name="FEMTO_PROVISIONING_MONITORING_ACTION")
 * @ORM\Entity
 */
class FemtoProvisioningMonitoringAction
{
    const COMMANDE = 1;
    const MANAGE_MSISDN = 2;
    const ACTIVATION = 11;
    const RESILIATION = 12;
    const CHANGE_HOST = 13;
    const REPLACE_BOX = 14;
    const ADD_MSISDN = 21;
    const REMOVE_MSISDN = 22;
    const CHANGE_MSISDN = 23;
    const CHANGE_IMSI = 24;

    /**
     * @var integer
     *
     * @ORM\Column(name="TYPE_ACTION_ID", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $typeActionId;

    /**
     * @var string
     *
     * @ORM\Column(name="INTITULE", type="string", length=50, nullable=false)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=300, nullable=false)
     */
    private $description;



    /**
     * Get typeActionId
     *
     * @return integer 
     */
    public function getTypeActionId()
    {
        return $this->typeActionId;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return FemtoProvisioningMonitoringAction
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    
        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return FemtoProvisioningMonitoringAction
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