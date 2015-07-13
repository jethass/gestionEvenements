<?php

namespace Omea\Entity\GestionEvenements;

use Doctrine\ORM\Mapping as ORM;
use Omea\GestionTelco\EvenementBundle\ActeManager\ActeDefinitionInterface;

/**
 * ActeDefinition.
 *
 * @ORM\Table("ACTE_DEFINITIONS")
 * @ORM\Entity(repositoryClass="ActeDefinitionRepository")
 */
class ActeDefinition implements ActeDefinitionInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ACTE_DEFINITION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idActeDefinition;

     /**
      * @ORM\ManyToOne(targetEntity="Omea\Entity\GestionEvenements\Acte")
      * @ORM\JoinColumn(name="ID_ACTE", referencedColumnName="ID_ACTE")
      */
     private $acte;

     /**
      * @ORM\ManyToOne(targetEntity="Omea\Entity\GestionEvenements\EvenementDefinition", inversedBy="actesDefinition")
      * @ORM\JoinColumn(name="ID_EVENEMENT_DEFINITION", referencedColumnName="ID_EVENEMENT_DEFINITION")
      */
     private $evenementsDefinition;

    /**
     * @var int
     *
     * @ORM\Column(name="POIDS", type="integer")
     */
    private $poids;

    /**
     * Get id.
     *
     * @return int
     */
    public function getIdActeDefinition()
    {
        return $this->idActeDefinition;
    }

    /**
     * Set poids.
     *
     * @param int $poids
     *
     * @return ActeDefinition
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids.
     *
     * @return int
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set acte.
     *
     * @param \Omea\Entity\Acte $acte
     *
     * @return ActeDefinition
     */
    public function setActe(Acte $acte = null)
    {
        $this->acte = $acte;

        return $this;
    }

    /**
     * Get acte.
     *
     * @return \Omea\Entity\Acte
     */
    public function getActe()
    {
        return $this->acte;
    }
    
	/**
     * @return the $evenementsDefinition
     */
    public function getEvenementsDefinition()
    {
        return $this->evenementsDefinition;
    }

	/**
     * @param number $idActeDefinition
     */
    public function setIdActeDefinition($idActeDefinition)
    {
        $this->idActeDefinition = $idActeDefinition;
    }

	/**
     * @param field_type $evenementsDefinition
     */
    public function setEvenementsDefinition($evenementsDefinition)
    {
        $this->evenementsDefinition = $evenementsDefinition;
    }

    /**
     * Nom de l'option.
     *
     * @return [type] [description]
     */
    public function getName(){
        return $this->getActe()->getService()->getNom();
    }
    
    /**
     * Options de l'acte sérialisé.
     *
     * @return string
    */
    public function getOptions(){
        return $this->getActe()->getOptions();
    }

}
