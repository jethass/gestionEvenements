<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="SERVICE_BAL")
 * @ORM\Entity
 */
class ServiceBal
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
     * @ORM\Column(name="NIVEAU_BAL", type="string")
     */
    private $niveauBal;

    /**
     * @var email
     *
     * @ORM\Column(name="EMAIL", type="string")
     */
    private $email;
    
    /**
     * @var pwd
     *
     * @ORM\Column(name="PWD", type="string")
     */
    private $pwd;
    
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
     * @return the $niveauBal
     */
    public function getNiveauBal()
    {
        return $this->niveauBal;
    }

	/**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

	/**
     * @return the $pwd
     */
    public function getPwd()
    {
        return $this->pwd;
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
     * @param string $niveauBal
     */
    public function setNiveauBal($niveauBal)
    {
        $this->niveauBal = $niveauBal;
    }

	/**
     * @param \Omea\Entity\Main\email $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

	/**
     * @param \Omea\Entity\Main\pwd $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }


}
