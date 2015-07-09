<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoMsisdnState
 *
 * @ORM\Table(name="FEMTO_MSISDN_STATE")
 * @ORM\Entity
 */
class FemtoMsisdnState
{
    const EN_ATTENTE = 0;
    const ACTIF = 1;
    const RETRAIT_EN_COURS = 2;
    const RETIRE = 3;
    const EN_ERREUR = 4;

    /**
     * @var integer
     *
     * @ORM\Column(name="FMS_ID", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fmsId;

    /**
     * @var string
     *
     * @ORM\Column(name="LABEL", type="string", length=45, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=300, nullable=false)
     */
    private $description;



    /**
     * Get fmsId
     *
     * @return integer 
     */
    public function getFmsId()
    {
        return $this->fmsId;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return FemtoMsisdnState
     */
    public function setLabel($label)
    {
        $this->label = $label;
    
        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return FemtoMsisdnState
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
