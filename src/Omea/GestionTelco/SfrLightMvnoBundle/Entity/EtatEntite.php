<?php

namespace Omea\GestionTelco\SfrLightMvnoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\GestionTelco\SfrLightMvnoBundle\Entity\EtatEntite
 *
 * @ORM\Table(name="ETAT_ENTITE")
 * @ORM\Entity()
 */
class EtatEntite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ETAT", type="integer")
     * @ORM\Id
     */
    private $idEtat;

    /**
     * @var integer
     *
     * @ORM\Column(name="LIBELLE", type="string")
     */
    private $libelle;


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
     * Set idEtat
     *
     * @param integer $idEtat
     * @return EtatEntite
     */
    public function setIdEtat($idEtat)
    {
        $this->idEtat = $idEtat;
    
        return $this;
    }

    /**
     * Get idEtat
     *
     * @return integer 
     */
    public function getIdEtat()
    {
        return $this->idEtat;
    }

    /**
     * Set libelle
     *
     * @param integer $libelle
     * @return EtatEntite
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return integer 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
}