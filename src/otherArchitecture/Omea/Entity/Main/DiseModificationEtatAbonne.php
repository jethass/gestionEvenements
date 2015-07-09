<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="DISE_MODIFICATION_ETAT_ABONNE")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\DiseModificationEtatAbonneRepository")
 */
class DiseModificationEtatAbonne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_DMEA", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDmea;

    /**
     * @ORM\ManyToOne(targetEntity="DiseAbonnement", inversedBy="diseModificationEtatAbonnes")
     * @ORM\JoinColumn(name="NUM_ABO", referencedColumnName="NUM_ABO", nullable=true)
     */
    private $diseAbonnement;

    /**
     * @ORM\Column(name="TYPE_MODIFICATION", type="string", length=6, nullable=true)
     */
    private $typeModification;

    /**
     * @ORM\Column(name="DATE_HEURE_EFFET", type="datetime", nullable=true)
     */
    private $dateHeureEffet;

    /**
     * @ORM\Column(name="STATUT_ABONNEMENT", type="string", length=2, nullable=true)
     */
    private $statutAbonnement;

    /**
     * @ORM\Column(name="CANAL", type="string", length=4, nullable=true)
     */
    private $canal;

    /**
     * Gets the value of idDmea.
     *
     * @return integer
     */
    public function getIdDmea()
    {
        return $this->idDmea;
    }

    /**
     * Sets the value of idDmea.
     *
     * @param integer $idDmea the id dmea
     *
     * @return self
     */
    public function setIdDmea($idDmea)
    {
        $this->idDmea = $idDmea;

        return $this;
    }

    /**
     * Gets the value of diseAbonnement.
     *
     * @return mixed
     */
    public function getDiseAbonnement()
    {
        return $this->diseAbonnement;
    }

    /**
     * Sets the value of diseAbonnement.
     *
     * @param mixed $diseAbonnement the dise abonnement
     *
     * @return self
     */
    public function setDiseAbonnement(DiseAbonnement $diseAbonnement = null)
    {
        $this->diseAbonnement = $diseAbonnement;

        return $this;
    }

    /**
     * Gets the value of typeModification.
     *
     * @return mixed
     */
    public function getTypeModification()
    {
        return $this->typeModification;
    }

    /**
     * Sets the value of typeModification.
     *
     * @param mixed $typeModification the type modification
     *
     * @return self
     */
    public function setTypeModification($typeModification)
    {
        $this->typeModification = $typeModification;

        return $this;
    }

    /**
     * Gets the value of dateHeureEffet.
     *
     * @return \DateTime
     */
    public function getDateHeureEffet()
    {
        return $this->dateHeureEffet;
    }

    /**
     * Sets the value of dateHeureEffet.
     *
     * @param \DateTime $dateHeureEffet the date heure effet
     *
     * @return self
     */
    public function setDateHeureEffet(\DateTime $dateHeureEffet = null)
    {
        $this->dateHeureEffet = $dateHeureEffet;

        return $this;
    }

    /**
     * Gets the value of statutAbonnement.
     *
     * @return mixed
     */
    public function getStatutAbonnement()
    {
        return $this->statutAbonnement;
    }

    /**
     * Sets the value of statutAbonnement.
     *
     * @param mixed $statutAbonnement the statut abonnement
     *
     * @return self
     */
    public function setStatutAbonnement($statutAbonnement)
    {
        $this->statutAbonnement = $statutAbonnement;

        return $this;
    }

    /**
     * Gets the value of canal.
     *
     * @return mixed
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Sets the value of canal.
     *
     * @param mixed $canal the canal
     *
     * @return self
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;

        return $this;
    }
}
