<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="SERVICE_INTERNET")
 * @ORM\Entity
 */
class ServiceInternet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ID_LIGNE_ADSL", type="integer")
     */
    private $idLigneAdsl;
    
    /**
     * @var string
     *
     * @ORM\Column(name="STATUT", type="string")
     */
    private $statut;
    
    /**
     * @var string
     *
     * @ORM\Column(name="PPP_LOGIN", type="string")
     */
    private $pppLogin;
    
    /**
     * @var string
     *
     * @ORM\Column(name="PPP_PASSWORD", type="string")
     */
    private $pppPassword;
    
    /**
     * @var string
     *
     * @ORM\Column(name="DATE_CREATION", type="datetime")
     */
    private $dateCreation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="DATE_MODIFICATION", type="datetime")
     */
    private $dateModification;
    
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @return the $idLigneAdsl
     */
    public function getIdLigneAdsl()
    {
        return $this->idLigneAdsl;
    }

	/**
     * @return the $statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

	/**
     * @return the $pppLogin
     */
    public function getPppLogin()
    {
        return $this->pppLogin;
    }

	/**
     * @return the $pppPassword
     */
    public function getPppPassword()
    {
        return $this->pppPassword;
    }

	/**
     * @return the $dateCreation
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

	/**
     * @return the $dateModification
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @param string $idLigneAdsl
     */
    public function setIdLigneAdsl($idLigneAdsl)
    {
        $this->idLigneAdsl = $idLigneAdsl;
    }

	/**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

	/**
     * @param string $pppLogin
     */
    public function setPppLogin($pppLogin)
    {
        $this->pppLogin = $pppLogin;
    }

	/**
     * @param string $pppPassword
     */
    public function setPppPassword($pppPassword)
    {
        $this->pppPassword = $pppPassword;
    }

	/**
     * @param string $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

	/**
     * @param string $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    
}
