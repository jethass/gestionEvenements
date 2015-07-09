<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatStock
 *
 * @ORM\Table(name="ETAT_STOCK")
 * @ORM\Entity
 */
class EtatStock
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ES", type="string")
     * @ORM\Id
     */
    private $idEs;

    /**
     * @var integer
     *
     * @ORM\Column(name="ETAT", type="integer")
     */
    private $etat;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idEs
     *
     * @param integer $idEs
     * @return EtatStock
     */
    public function setIdEs($idEs)
    {
        $this->idEs = $idEs;
    
        return $this;
    }

    /**
     * Get idEs
     *
     * @return integer 
     */
    public function getIdEs()
    {
        return $this->idEs;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return EtatStock
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }
}