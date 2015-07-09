<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OMD_PNM_IN")
 * @ORM\Entity
 */
class OmdPnmIn
{
    /**
     * @var integer $operation
     * @ORM\Column(name="OPERATION", type="string", length=3, nullable=false)
     * @ORM\Id
     */
    private $operation;

    /**
     * @var integer $emetteur
     * @ORM\Column(name="EMETTEUR", type="string", length=2, nullable=false)
     * @ORM\Id
     */
    private $emetteur;

    /**
     * @var integer $recepteur
     * @ORM\Column(name="RECEPTEUR", type="string", length=2, nullable=false)
     * @ORM\Id
     */
    private $recepteur;

    /**
     * @var integer $etat
     * @ORM\Column(name="ETAT", type="string", length=2, nullable=false)
     * @ORM\Id
     */
    private $etat;

    /**
     * @var string $dateHeureEtat
     * @ORM\Column(name="DATEHEUREETAT", type="datetime", nullable=false)
     */
    private $dateHeureEtat;

    /**
     * @var string $msisdn
     * @ORM\Column(name="MSISDN", type="integer", length=10, nullable=false)
     */
    private $msisdn;

    /**
     * @var integer $rio
     * @ORM\Column(name="RIO", type="string", length=12, nullable=false)
     */
    private $rio;

    /**
     * @var integer $opr
     * @ORM\Column(name="OPR", type="string", length=2, nullable=false)
     */
    private $opr;

    /**
     * @var integer $oprt
     * @ORM\Column(name="OPRT", type="string", length=2)
     */
    private $oprt;

    /**
     * @var integer $opd
     * @ORM\Column(name="OPD", type="string", length=2, nullable=false)
     */
    private $opd;

    /**
     * @var integer $opdt
     * @ORM\Column(name="OPDT", type="string", length=2)
     */
    private $opdt;

    /**
     * @var integer $opa
     * @ORM\Column(name="OPA", type="string", length=2)
     */
    private $opa;

    /**
     * @var integer $opat
     * @ORM\Column(name="OPAT", type="string", length=2)
     */
    private $opat;

    /**
     * @var integer $idPortage
     * @ORM\Column(name="IDPORTAGE", type="string", length=12, nullable=false)
     * @ORM\Id
     */
    private $idPortage;

    /**
     * @var string $dateDemande
     * @ORM\Column(name="DATEDEMANDE", type="date", nullable=false)
     */
    private $dateDemande;

    /**
     * @var string $datePortage
     * @ORM\Column(name="DATEPORTAGE", type="date", nullable=false)
     */
    private $datePortage;

    /**
     * @var integer $tranche
     * @ORM\Column(name="TRANCHE", type="string", nullable=false)
     */
    private $tranche;

    /**
     * @var integer $champ1
     * @ORM\Column(name="CHAMP1", type="string", length=30)
     */
    private $champ1;

    /**
     * @var integer $champ2
     * @ORM\Column(name="CHAMP2", type="string", length=30)
     */
    private $champ2;

    /**
     * @var interger $codeRetour
     * @ORM\Column(name="CODERETOUR", type="integer", length=3)
     */
    private $codeRetour;

    /**
     * @var string $opet
     * @ORM\Column(name="OPET", type="string", length=2)
     */
    private $opet;

    /**
     * @var string $dateRestitution
     * @ORM\Column(name="DATERESTITUTION", type="date", nullable=false)
     */
    private $dateRestitution;
	/**
     * @return the $operation
     */
    public function getOperation() {
        return $this->operation;
    }

	/**
     * @param number $operation
     */
    public function setOperation($operation) {
        $this->operation = $operation;
    }

	/**
     * @return the $emetteur
     */
    public function getEmetteur() {
        return $this->emetteur;
    }

	/**
     * @param number $emetteur
     */
    public function setEmetteur($emetteur) {
        $this->emetteur = $emetteur;
    }

	/**
     * @return the $recepteur
     */
    public function getRecepteur() {
        return $this->recepteur;
    }

	/**
     * @param number $recepteur
     */
    public function setRecepteur($recepteur) {
        $this->recepteur = $recepteur;
    }

	/**
     * @return the $etat
     */
    public function getEtat() {
        return $this->etat;
    }

	/**
     * @param number $etat
     */
    public function setEtat($etat) {
        $this->etat = $etat;
    }

	/**
     * @return the $dateHeureEtat
     */
    public function getDateHeureEtat() {
        return $this->dateHeureEtat;
    }

	/**
     * @param string $dateHeureEtat
     */
    public function setDateHeureEtat($dateHeureEtat) {
        $this->dateHeureEtat = $dateHeureEtat;
    }

	/**
     * @return the $msisdn
     */
    public function getMsisdn() {
        return $this->msisdn;
    }

	/**
     * @param string $msisdn
     */
    public function setMsisdn($msisdn) {
        $this->msisdn = $msisdn;
    }

	/**
     * @return the $rio
     */
    public function getRio() {
        return $this->rio;
    }

	/**
     * @param number $rio
     */
    public function setRio($rio) {
        $this->rio = $rio;
    }

	/**
     * @return the $opr
     */
    public function getOpr() {
        return $this->opr;
    }

	/**
     * @param number $opr
     */
    public function setOpr($opr) {
        $this->opr = $opr;
    }

	/**
     * @return the $oprt
     */
    public function getOprt() {
        return $this->oprt;
    }

	/**
     * @param number $oprt
     */
    public function setOprt($oprt) {
        $this->oprt = $oprt;
    }

	/**
     * @return the $opd
     */
    public function getOpd() {
        return $this->opd;
    }

	/**
     * @param number $opd
     */
    public function setOpd($opd) {
        $this->opd = $opd;
    }

	/**
     * @return the $opdt
     */
    public function getOpdt() {
        return $this->opdt;
    }

	/**
     * @param number $opdt
     */
    public function setOpdt($opdt) {
        $this->opdt = $opdt;
    }

	/**
     * @return the $opa
     */
    public function getOpa() {
        return $this->opa;
    }

	/**
     * @param number $opa
     */
    public function setOpa($opa) {
        $this->opa = $opa;
    }

	/**
     * @return the $opat
     */
    public function getOpat() {
        return $this->opat;
    }

	/**
     * @param number $opat
     */
    public function setOpat($opat) {
        $this->opat = $opat;
    }

	/**
     * @return the $idPortage
     */
    public function getIdPortage() {
        return $this->idPortage;
    }

	/**
     * @param number $idPortage
     */
    public function setIdPortage($idPortage) {
        $this->idPortage = $idPortage;
    }

	/**
     * @return the $dateDemande
     */
    public function getDateDemande() {
        return $this->dateDemande;
    }

	/**
     * @param string $dateDemande
     */
    public function setDateDemande($dateDemande) {
        $this->dateDemande = $dateDemande;
    }

	/**
     * @return the $datePortage
     */
    public function getDatePortage() {
        return $this->datePortage;
    }

	/**
     * @param string $datePortage
     */
    public function setDatePortage($datePortage) {
        $this->datePortage = $datePortage;
    }

	/**
     * @return the $tranche
     */
    public function getTranche() {
        return $this->tranche;
    }

	/**
     * @param number $tranche
     */
    public function setTranche($tranche) {
        $this->tranche = $tranche;
    }

	/**
     * @return the $champ1
     */
    public function getChamp1() {
        return $this->champ1;
    }

	/**
     * @param number $champ1
     */
    public function setChamp1($champ1) {
        $this->champ1 = $champ1;
    }

	/**
     * @return the $champ2
     */
    public function getChamp2() {
        return $this->champ2;
    }

	/**
     * @param number $champ2
     */
    public function setChamp2($champ2) {
        $this->champ2 = $champ2;
    }

	/**
     * @return the $codeRetour
     */
    public function getCodeRetour() {
        return $this->codeRetour;
    }

	/**
     * @param string $codeRetour
     */
    public function setCodeRetour($codeRetour) {
        $this->codeRetour = $codeRetour;
    }

	/**
     * @return the $opet
     */
    public function getOpet() {
        return $this->opet;
    }

	/**
     * @param string $opet
     */
    public function setOpet($opet) {
        $this->opet = $opet;
    }

	/**
     * @return the $dateRestitution
     */
    public function getDateRestitution() {
        return $this->dateRestitution;
    }

	/**
     * @param string $dateRestitution
     */
    public function setDateRestitution($dateRestitution) {
        $this->dateRestitution = $dateRestitution;
    }

}
