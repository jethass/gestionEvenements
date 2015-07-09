<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="DISE_PNM_IN")
 * @ORM\Entity
 */
class DisePnmIn
{
    /**
     * @var integer $idDpi
     * @ORM\Column(name="ID_DPI", type="integer", length=10)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDpi;

    /**
     * @var integer $idClient
     * @ORM\Column(name="ID_CLIENT", type="integer", length=11)
     */
    private $idClient;

    /**
     * @var string $idPortage
     * @ORM\Column(name="IDPORTAGE", type="string", length=12)
     */
    private $idPortage;

    /**
     * @var string $bonPortage
     * @ORM\Column(name="BON_PORTAGE", type="string", length=12)
     */
    private $bonPortage;

    /**
     * @var string $msisdnAPorter
     * @ORM\Column(name="MSISDN_A_PORTER", type="integer", length=10)
     */
    private $msisdnAPorter;

    /**
     * @var string $operateurAttributaire
     * @ORM\Column(name="OPERATEUR_ATTRIBUTAIRE", type="string", length=2)
     */
    private $operateurAttributaire;

    /**
     * @var string $operateurDonneur
     * @ORM\Column(name="OPERATEUR_DONNEUR", type="string", length=2)
     */
    private $operateurDonneur;

    /**
     * @var string $datePortage
     * @ORM\Column(name="DATE_PORTAGE", type="date")
     */
    private $datePortage;

    /**
     * @var string $dateValidite
     * @ORM\Column(name="DATE_VALIDITE", type="date")
     */
    private $dateValidite;

    /**
     * @var string $clefControle
     * @ORM\Column(name="CLEF_CONTROLE", type="string", length=3)
     */
    private $clefControle;

    /**
     * @var string $dateInsertion
     * @ORM\Column(name="DATE_INSERTION", type="datetime")
     */
    private $dateInsertion;

    /**
     * @var string $traite
     * @ORM\Column(name="TRAITE", type="boolean")
     */
    private $traite;

    /**
     * @var string $activPnmV1
     * @ORM\Column(name="ACTIV_PNM_V1", type="integer", length=4)
     */
    private $activPnmV1;

    /**
     * @var string $notifie
     * @ORM\Column(name="NOTIFIE", type="boolean")
     */
    private $notifie;

    /**
     * @return the $idDpi
     */
    public function getIdDpi()
    {
        return $this->idDpi;
    }

    /**
     * @param number $idDpi
     */
    public function setIdDpi($idDpi)
    {
        $this->idDpi = $idDpi;
    }

    /**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param number $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @return the $idPortage
     */
    public function getIdPortage()
    {
        return $this->idPortage;
    }

    /**
     * @param string $idPortage
     */
    public function setIdPortage($idPortage)
    {
        $this->idPortage = $idPortage;
    }

    /**
     * @return the $bonPortage
     */
    public function getBonPortage()
    {
        return $this->bonPortage;
    }

    /**
     * @param string $bonPortage
     */
    public function setBonPortage($bonPortage)
    {
        $this->bonPortage = $bonPortage;
    }

    /**
     * @return the $msisdnAPorter
     */
    public function getMsisdnAPorter()
    {
        return $this->msisdnAPorter;
    }

    /**
     * @param string $msisdnAPorter
     */
    public function setMsisdnAPorter($msisdnAPorter)
    {
        $this->msisdnAPorter = $msisdnAPorter;
    }

    /**
     * @return the $operateurAttributaire
     */
    public function getOperateurAttributaire()
    {
        return $this->operateurAttributaire;
    }

    /**
     * @param string $operateurAttributaire
     */
    public function setOperateurAttributaire($operateurAttributaire)
    {
        $this->operateurAttributaire = $operateurAttributaire;
    }

    /**
     * @return the $operateurDonneur
     */
    public function getOperateurDonneur()
    {
        return $this->operateurDonneur;
    }

    /**
     * @param string $operateurDonneur
     */
    public function setOperateurDonneur($operateurDonneur)
    {
        $this->operateurDonneur = $operateurDonneur;
    }

    /**
     * @return the $datePortage
     */
    public function getDatePortage()
    {
        return $this->datePortage;
    }

    /**
     * @param string $datePortage
     */
    public function setDatePortage($datePortage)
    {
        $this->datePortage = $datePortage;
    }

    /**
     * @return the $dateValidite
     */
    public function getDateValidite()
    {
        return $this->dateValidite;
    }

    /**
     * @param string $dateValidite
     */
    public function setDateValidite($dateValidite)
    {
        $this->dateValidite = $dateValidite;
    }

    /**
     * @return the $clefControle
     */
    public function getClefControle()
    {
        return $this->clefControle;
    }

    /**
     * @param string $clefControle
     */
    public function setClefControle($clefControle)
    {
        $this->clefControle = $clefControle;
    }

    /**
     * @return the $dateInsertion
     */
    public function getDateInsertion()
    {
        return $this->dateInsertion;
    }

    /**
     * @param string $dateInsertion
     */
    public function setDateInsertion($dateInsertion)
    {
        $this->dateInsertion = $dateInsertion;
    }

    /**
     * @return the $traite
     */
    public function getTraite()
    {
        return $this->traite;
    }

    /**
     * @param string $traite
     */
    public function setTraite($traite)
    {
        $this->traite = $traite;
    }

    /**
     * @return the $activPnmV1
     */
    public function getActivPnmV1()
    {
        return $this->activPnmV1;
    }

    /**
     * @param string $activPnmV1
     */
    public function setActivPnmV1($activPnmV1)
    {
        $this->activPnmV1 = $activPnmV1;
    }

    /**
     * @return the $notifie
     */
    public function getNotifie()
    {
        return $this->notifie;
    }

    /**
     * @param string $notifie
     */
    public function setNotifie($notifie)
    {
        $this->notifie = $notifie;
    }
}
