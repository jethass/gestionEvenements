<?php
/**
 * Created by PhpStorm.
 * User: smekkaoui
 * Date: 11/06/2015
 * Time: 15:16
 */

namespace Omea\Entity\Main;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OMD_PNM_OUT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\OmdPnmOutRepository")
 */
class OmdPnmOut {
    /**
     * @var integer $idOpo
     * @ORM\Id
     * @ORM\Column(name="ID_OPO", type="integer")
     */
    private $idOpo;

    /**
     * @var string $operation
     * @ORM\Column(name="OPERATION", type="string", length=3)
     */
    private $operation;

    /**
     * @var string $emetteur
     * @ORM\Column(name="EMETTEUR", type="string", length=2)
     */
    private $emetteur;

    /**
     * @var string $emetteur
     * @ORM\Column(name="RECEPTEUR", type="string", length=2)
     */
    private $recepteur;

    /**
     * @var string $emetteur
     * @ORM\Column(name="ETAT", type="string", length=2)
     */
    private $etat;

    /**
     * @var \DateTime $dateHeureEtat
     * @ORM\Column(name="DATEHEUREETAT", type="datetime")
     */
    private $dateHeureEtat;

    /**
     * @var integer $msisdn
     * @ORM\Column(name="MSISDN", type="integer")
     */
    private $msisdn;

    /**
     * @var StockMsisdn $stockMsisdn
     * @ORM\ManyToOne(targetEntity="StockMsisdn")
     * @ORM\JoinColumn(name="MSISDN", referencedColumnName="MSISDN")
     */
    private $stockMsisdn;
    /**
     * @var integer $rio
     * @ORM\Column(name="RIO", type="string", length=12)
     */
    private $rio;

    /**
     * @var string $opr
     * @ORM\Column(name="OPR", type="string", length=2)
     */
    private $opr;

    /**
     * @var string $oprt
     * @ORM\Column(name="OPRT", type="string", length=2)
     */
    private $oprt;

    /**
     * @var string $opd
     * @ORM\Column(name="OPT", type="string", length=2)
     */
    private $opd;

    /**
     * @var string $opdt
     * @ORM\Column(name="OPDT", type="string", length=2)
     */
    private $opdt;

    /**
     * @var string $opa
     * @ORM\Column(name="OPA", type="string", length=2)
     */
    private $opa;

    /**
     * @var string $opat
     * @ORM\Column(name="OPAT", type="string", length=2)
     */
    private $opat;

    /**
     * @var string $idPortage
     * @ORM\Column(name="IDPORTAGE", type="string", length=2)
     */
    private $idPortage;

    /**
     * @var OmdPnmIn $omdPnmIn
     * @ORM\OneToOne(targetEntity="OmdPnmIn")
     * @ORM\JoinColumn(name="IDPORTAGE", referencedColumnName="IDPORTAGE")
     */
    private $omdPnmIn;

    /**
     * @var \DateTime $dateDemande
     * @ORM\Column(name="DATEDEMANDE", type="datetime")
     */
    private $dateDemande;

    /**
     * @var \DateTime $datePortage
     * @ORM\Column(name="DATEPORTAGE", type="datetime")
     */
    private $datePortage;

    /**
     * @var string $tranche
     * @ORM\Column(name="TRANCHE", type="string", columnDefinition="ENUM('11', '15', '51', '55')", length=2)
     */
    private $tranche;

    /**
     * @var string $champ1
     * @ORM\Column(name="CHAMP1", type="string", length=2)
     */
    private $champ1;

    /**
     * @var string $idPortage
     * @ORM\Column(name="CHAMP2", type="string", length=2)
     */
    private $champ2;

    /**
     * @var string $codeRetour
     * @ORM\Column(name="CODERETOUR", type="integer")
     */
    private $codeRetour;

    /**
     * @return int
     */
    public function getIdOpo()
    {
        return $this->idOpo;
    }

    /**
     * @param int $idOpo
     */
    public function setIdOpo($idOpo)
    {
        $this->idOpo = $idOpo;
    }

    /**
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return string
     */
    public function getEmetteur()
    {
        return $this->emetteur;
    }

    /**
     * @param string $emetteur
     */
    public function setEmetteur($emetteur)
    {
        $this->emetteur = $emetteur;
    }

    /**
     * @return string
     */
    public function getRecepteur()
    {
        return $this->recepteur;
    }

    /**
     * @param string $recepteur
     */
    public function setRecepteur($recepteur)
    {
        $this->recepteur = $recepteur;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return \DateTime
     */
    public function getDateHeureEtat()
    {
        return $this->dateHeureEtat;
    }

    /**
     * @param \DateTime $dateHeureEtat
     */
    public function setDateHeureEtat($dateHeureEtat)
    {
        $this->dateHeureEtat = $dateHeureEtat;
    }

    /**
     * @return int
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param int $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    /**
     * @return StockMsisdn
     */
    public function getStockMsisdn()
    {
        return $this->stockMsisdn;
    }

    /**
     * @param StockMsisdn $stockMsisdn
     */
    public function setStockMsisdn($stockMsisdn)
    {
        $this->stockMsisdn = $stockMsisdn;
    }

    /**
     * @return int
     */
    public function getRio()
    {
        return $this->rio;
    }

    /**
     * @param int $rio
     */
    public function setRio($rio)
    {
        $this->rio = $rio;
    }

    /**
     * @return string
     */
    public function getOpr()
    {
        return $this->opr;
    }

    /**
     * @param string $opr
     */
    public function setOpr($opr)
    {
        $this->opr = $opr;
    }

    /**
     * @return string
     */
    public function getOprt()
    {
        return $this->oprt;
    }

    /**
     * @param string $oprt
     */
    public function setOprt($oprt)
    {
        $this->oprt = $oprt;
    }

    /**
     * @return string
     */
    public function getOpd()
    {
        return $this->opd;
    }

    /**
     * @param string $opd
     */
    public function setOpd($opd)
    {
        $this->opd = $opd;
    }

    /**
     * @return string
     */
    public function getOpdt()
    {
        return $this->opdt;
    }

    /**
     * @param string $opdt
     */
    public function setOpdt($opdt)
    {
        $this->opdt = $opdt;
    }

    /**
     * @return string
     */
    public function getOpa()
    {
        return $this->opa;
    }

    /**
     * @param string $opa
     */
    public function setOpa($opa)
    {
        $this->opa = $opa;
    }

    /**
     * @return string
     */
    public function getOpat()
    {
        return $this->opat;
    }

    /**
     * @param string $opat
     */
    public function setOpat($opat)
    {
        $this->opat = $opat;
    }

    /**
     * @return string
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
     * @return OmdPnmIn
     */
    public function getOmdPnmIn()
    {
        return $this->omdPnmIn;
    }

    /**
     * @param OmdPnmIn $omdPnmIn
     */
    public function setOmdPnmIn($omdPnmIn)
    {
        $this->omdPnmIn = $omdPnmIn;
    }

    /**
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * @param \DateTime $dateDemande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;
    }

    /**
     * @return \DateTime
     */
    public function getDatePortage()
    {
        return $this->datePortage;
    }

    /**
     * @param \DateTime $datePortage
     */
    public function setDatePortage($datePortage)
    {
        $this->datePortage = $datePortage;
    }

    /**
     * @return string
     */
    public function getTranche()
    {
        return $this->tranche;
    }

    /**
     * @param string $tranche
     */
    public function setTranche($tranche)
    {
        $this->tranche = $tranche;
    }

    /**
     * @return string
     */
    public function getChamp1()
    {
        return $this->champ1;
    }

    /**
     * @param string $champ1
     */
    public function setChamp1($champ1)
    {
        $this->champ1 = $champ1;
    }

    /**
     * @return string
     */
    public function getChamp2()
    {
        return $this->champ2;
    }

    /**
     * @param string $champ2
     */
    public function setChamp2($champ2)
    {
        $this->champ2 = $champ2;
    }

    /**
     * @return string
     */
    public function getCodeRetour()
    {
        return $this->codeRetour;
    }

    /**
     * @param string $codeRetour
     */
    public function setCodeRetour($codeRetour)
    {
        $this->codeRetour = $codeRetour;
    }

}