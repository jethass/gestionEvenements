<?php

namespace Omea\GestionTelco\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvenementDefinitions
 *
 * @ORM\Table(name="EVENEMENTS_DEFINITIONS", indexes={@ORM\Index(name="code_idx", columns={"CODE"})})
 * @ORM\Entity
 */
class EvenementDefinition
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_EVENEMENT_DEFINITION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    private $idEvenementDefinition;
    

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdEvenementDefinition()
    {
        return $this->idEvenementDefinition;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return EvenementDefinition
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return EvenementDefinitions
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
