<?php

namespace Omea\GestionTelco\EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Omea\GestionTelco\EvenementBundle\ActeManager\Interfaces\ActeDefinitionInterface;

/**
 * ActeDefinition
 *
 * @ORM\Table("ACTE_DEFINITIONS")
 * @ORM\Entity(repositoryClass="Omea\GestionTelco\EvenementBundle\Entity\ActeDefinitionRepository")
 */
class ActeDefinition implements ActeDefinitionInterface
{
    
     /**
     * @var integer
     *
     * @ORM\Column(name="ID_ACTE_DEFINITION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActeDefinition;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Omea\GestionTelco\EvenementBundle\Entity\Acte")
     * @ORM\JoinColumn(name="ID_ACTE", referencedColumnName="ID_ACTE")
     */
     private $acte;
     
     /**
     * @ORM\ManyToOne(targetEntity="Omea\GestionTelco\EvenementBundle\Entity\EvenementDefinition")
      * @ORM\JoinColumn(name="ID_EVENEMENT_DEFINITION", referencedColumnName="ID_EVENEMENT_DEFINITION")
     */
     private $evenementDefinition;
     

    /**
     * @var integer
     *
     * @ORM\Column(name="poids", type="integer")
     */
    private $poids;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdActeDefinition()
    {
        return $this->idActeDefinition;
    }

    /**
     * Set poids
     *
     * @param integer $poids
     * @return ActeDefinition
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return integer 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set acte
     *
     * @param \Omea\GestionTelco\EvenementBundle\Entity\Acte $acte
     *
     * @return ActeDefinition
     */
    public function setActe(\Omea\GestionTelco\EvenementBundle\Entity\Acte $acte = null)
    {
        $this->acte = $acte;

        return $this;
    }

    /**
     * Get acte
     *
     * @return \Omea\GestionTelco\EvenementBundle\Entity\Acte
     */
    public function getActe()
    {
        return $this->acte;
    }

    /**
     * Set evenementDefinition
     *
     * @param \Omea\GestionTelco\EvenementBundle\Entity\EvenementDefinition $evenementDefinition
     *
     * @return ActeDefinition
     */
    public function setEvenementDefinition(\Omea\GestionTelco\EvenementBundle\Entity\EvenementDefinition $evenementDefinition = null)
    {
        $this->evenementDefinition = $evenementDefinition;

        return $this;
    }

    /**
     * Get evenementDefinition
     *
     * @return \Omea\GestionTelco\EvenementBundle\Entity\EvenementDefinition
     */
    public function getEvenementDefinition()
    {
        return $this->evenementDefinition;
    }

}
