<?php

namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FemtoActiveClientState
 *
 * @ORM\Table(name="FEMTO_ACTIVE_CLIENT_STATE")
 * @ORM\Entity
 */
class FemtoActiveClientState
{
    const COMMANDE = 0;
    const EN_ATTENTE = 1;
    const ACTIF = 2;
    const EN_RESILIATION = 3;
    const RESILIE = 4;

    /**
     * @var integer
     *
     * @ORM\Column(name="FACS_ID", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $facsId;

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
     * Get facsId
     *
     * @return integer 
     */
    public function getFacsId()
    {
        return $this->facsId;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return FemtoActiveClientState
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
     * @return FemtoActiveClientState
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
