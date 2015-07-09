<?php

namespace Omea\Entity\GestionEvenements;

use Doctrine\ORM\Mapping as ORM;

/**
 * EvenementDefinitions.
 *
 * @ORM\Table(name="EVENEMENTS_DEFINITIONS", indexes={@ORM\Index(name="code_idx", columns={"CODE"})})
 * @ORM\Entity(repositoryClass="EvenementDefinitionRepository")
 */
class EvenementDefinition
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_EVENEMENT_DEFINITION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvenementDefinition;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE", type="string", length=10)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPTION", type="string", length=255)
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Omea\Entity\GestionEvenements\ActeDefinition", mappedBy="evenementsDefinition")
     * @ORM\JoinColumn(name="ID_EVENEMENT_DEFINITION", referencedColumnName="ID_EVENEMENT_DEFINITION")
     */
    private $actesDefinition;

    /**
     * @return the $actesDefinition
     */
    public function getActesDefinition()
    {
        return $this->actesDefinition;
    }

	/**
     * @param number $idEvenementDefinition
     */
    public function setIdEvenementDefinition($idEvenementDefinition)
    {
        $this->idEvenementDefinition = $idEvenementDefinition;
    }

	/**
     * @param field_type $actesDefinition
     */
    public function setActesDefinition($actesDefinition)
    {
        $this->actesDefinition = $actesDefinition;
    }

	/**
     * Get id.
     *
     * @return int
     */
    public function getIdEvenementDefinition()
    {
        return $this->idEvenementDefinition;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return EvenementDefinition
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return EvenementDefinitions
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
