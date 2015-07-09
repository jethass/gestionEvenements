<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EzabpqmOperateur
 *
 * @ORM\Table(name="EZABPQM_OPERATEUR", uniqueConstraints={@ORM\UniqueConstraint(name="UK_EZABPQM", columns={"EZABPQM"})})
 * @ORM\Entity
 */
class EzabpqmOperateur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="EZABPQM", type="string", length=7, nullable=false)
     */
    private $ezabpqm;

    /**
     * @var string
     *
     * @ORM\Column(name="MNEMO_OPERATEUR", type="string", length=4, nullable=false)
     */
    private $mnemoOperateur;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_OPERATEUR", type="string", length=128, nullable=true)
     */
    private $nomOperateur;

    /**
     * @var string
     *
     * @ORM\Column(name="ETAT", type="string", length=1, nullable=false)
     */
    private $etat = 'S';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_CREATION", type="datetime", nullable=false)
     */
    private $dateCreation = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE_MODIFICATION", type="datetime", nullable=false)
     */
    private $dateModification = '0000-00-00 00:00:00';

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    /**
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $ezabpqm
     */
    public function setEzabpqm($ezabpqm)
    {
        $this->ezabpqm = $ezabpqm;
    }

    /**
     * @return string
     */
    public function getEzabpqm()
    {
        return $this->ezabpqm;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $mnemoOperateur
     */
    public function setMnemoOperateur($mnemoOperateur)
    {
        $this->mnemoOperateur = $mnemoOperateur;
    }

    /**
     * @return string
     */
    public function getMnemoOperateur()
    {
        return $this->mnemoOperateur;
    }

    /**
     * @param string $nomOperateur
     */
    public function setNomOperateur($nomOperateur)
    {
        $this->nomOperateur = $nomOperateur;
    }

    /**
     * @return string
     */
    public function getNomOperateur()
    {
        return $this->nomOperateur;
    }

}
