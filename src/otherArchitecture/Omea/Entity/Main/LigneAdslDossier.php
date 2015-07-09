<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="LIGNE_ADSL_DOSSIER")
 * @ORM\Entity
 */
class LigneAdslDossier
{

    /**
     *
     * @var integer
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var integer
     * @ORM\Column(name="ID_LIGNE", type="integer")
     */
    private $idLigne;

    /**
     *
     * @var string
     * @ORM\Column(name="STATUT", type="string")
     */
    private $statut;
    
    /**
     *
     * @var string
     * @ORM\Column(name="ID_DOSSIER", type="string")
     */
    private $idDossier;
    
    /**
     *
     * @var datetime
     * @ORM\Column(name="DATE_CREATION", type="datetime")
     */
    private $dateCreation;
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $idLigne
     */
    public function getIdLigne()
    {
        return $this->idLigne;
    }

	/**
     * @return the $statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

	/**
     * @return the $idDossier
     */
    public function getIdDossier()
    {
        return $this->idDossier;
    }

	/**
     * @return the $dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @param number $idLigne
     */
    public function setIdLigne($idLigne)
    {
        $this->idLigne = $idLigne;
    }

	/**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

	/**
     * @param string $idDossier
     */
    public function setIdDossier($idDossier)
    {
        $this->idDossier = $idDossier;
    }

	/**
     * @param \Datetime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    
}
