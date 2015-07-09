<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CONTRAT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ContratRepository")
 */
class Contrat
{

    /**
     *
     * @var integer $idContrat
     *
     * @ORM\Column(name="ID_CONTRAT", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idContrat;

    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="contrat")
     */
    private $client;

    /**
     *
     * @var date $contratAnnule
     *
     * @ORM\Column(name="CONTRAT_ANNULE", type="date", nullable=true)
     */
    private $contratAnnule;

    /**
     * @ORM\ManyToOne(targetEntity="DossierRib", cascade={"persist"})
     * @ORM\JoinColumn(name="ID_DOSSIER", referencedColumnName = "ID_DOSSIER")
     */
    private $dossierRib;

    /**
     *
     * @var string $fichier
     *
     * @ORM\Column(name="FICHIER", type="string", length=30)
     */
    private $fichier;

    /**
     *
     * @var string $typePaiement
     *
     * @ORM\Column(name="TYPE_PAIEMENT", type="string", length=50)
     */
    private $typePaiement;

    /**
     *
     * @var decimal $depotGarantie
     *
     * @ORM\Column(name="DEPOT_GARANTIE", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $depotGarantie;

    /**
     *
     * @var integer $pjCpi
     *
     * @ORM\Column(name="PJ_CPI", type="integer")
     */
    private $pjCpi;

    /**
     *
     * @var string $typePjCpi
     *
     * @ORM\Column(name="TYPE_PJ_CPI", type="string", length=30, nullable=true)
     */
    private $typePjCpi;

    /**
     *
     * @var integer $typePieceCpi
     *
     * @ORM\Column(name="TYPE_PIECE_CPI", type="integer", nullable=true)
     */
    private $typePieceCpi;

    /**
     *
     * @var integer $pjCa
     *
     * @ORM\Column(name="PJ_CA", type="integer")
     */
    private $pjCa;

    /**
     *
     * @var integer $pjRib
     *
     * @ORM\Column(name="PJ_RIB", type="integer")
     */
    private $pjRib;

    /**
     *
     * @var integer $pjJd
     *
     * @ORM\Column(name="PJ_JD", type="integer", nullable=true)
     */
    private $pjJd;

    /**
     *
     * @var string $pjKbis
     *
     * @ORM\Column(name="PJ_KBIS", type="string", length=100, nullable=true)
     */
    private $pjKbis;

    /**
     *
     * @var string $pjPrj
     *
     * @ORM\Column(name="PJ_PRJ", type="string", length=100, nullable=true)
     */
    private $pjPrj;

    /**
     *
     * @var integer $pjCb
     *
     * @ORM\Column(name="PJ_CB", type="integer", nullable=true)
     */
    private $pjCb;

    /**
     *
     * @var integer $pjVip
     *
     * @ORM\Column(name="PJ_VIP", type="integer", nullable=true)
     */
    private $pjVip;

    /**
     *
     * @var string $cmc7Cheque
     *
     * @ORM\Column(name="CMC7_CHEQUE", type="string", length=33, nullable=true)
     */
    private $cmc7Cheque;

    /**
     *
     * @var integer $optFacture
     *
     * @ORM\Column(name="OPT_FACTURE", type="integer")
     */
    private $optFacture;

    /**
     *
     * @var integer $optFactPapier
     *
     * @ORM\Column(name="OPT_FACT_PAPIER", type="integer")
     */
    private $optFactPapier;

    /**
     *
     * @var string $optBillingElectronique
     *
     * @ORM\Column(name="OPT_BILLING_ELECTRONIQUE", type="string", length=255, nullable=true)
     */
    private $optBillingElectronique;

    /**
     *
     * @var string $optBillingSmsNum
     *
     * @ORM\Column(name="OPT_BILLING_SMS_NUM", type="string", length=10, nullable=true)
     */
    private $optBillingSmsNum;

    /**
     *
     * @var integer $optAnnuaire
     *
     * @ORM\Column(name="OPT_ANNUAIRE", type="integer")
     */
    private $optAnnuaire;

    /**
     *
     * @var integer $optAnnuaireCommercial
     *
     * @ORM\Column(name="OPT_ANNUAIRE_COMMERCIAL", type="integer")
     */
    private $optAnnuaireCommercial;

    /**
     *
     * @var integer $optAnnuaireInverse
     *
     * @ORM\Column(name="OPT_ANNUAIRE_INVERSE", type="integer")
     */
    private $optAnnuaireInverse;

    /**
     *
     * @var integer $optIllimiteVoix
     *
     * @ORM\Column(name="OPT_ILLIMITE_VOIX", type="integer")
     */
    private $optIllimiteVoix;

    /**
     *
     * @var integer $idCodeVip
     *
     * @ORM\Column(name="ID_CODE_VIP", type="integer", nullable=true)
     */
    private $idCodeVip;

    /**
     *
     * @var date $dateBilling
     *
     * @ORM\Column(name="DATE_BILLING", type="date", nullable=true)
     */
    private $dateBilling;

    /**
     *
     * @var integer $toSign
     *
     * @ORM\Column(name="TO_SIGN", type="integer")
     */
    private $toSign;

    /**
     *
     * @var integer $pieceType
     *
     * @ORM\Column(name="PIECE_TYPE", type="integer", nullable=true)
     */
    private $pieceType;

    /**
     *
     * @var string $pieceId
     *
     * @ORM\Column(name="PIECE_ID", type="integer", length=20, nullable=true)
     */
    private $pieceId;

    /**
     *
     * @var datetime $clicDate
     * @ORM\Column(name="CLIC_DATE", type="datetime", nullable=true)
     */
    private $clicDate;

    /**
     *
     * @var string $clicIp
     * @ORM\Column(name="CLIC_IP", type="integer", length=20, nullable=true)
     */
    private $clicIp;

    /**
     *
     * @var integer $statut
     * @ORM\Column(name="STATUT", type="integer", nullable=true)
     */
    private $statut;

    /**
     *
     * @var integer $pjUsurpid
     *
     * @ORM\Column(name="PJ_USURPID", type="integer", nullable=true)
     */
    private $pjUsurpid;

    /**
     *
     * @var string $statutSouscription
     *
     * @ORM\Column(name="STATUT_SOUSCRIPTION", type="integer", length=20, nullable=true)
     */
    private $statutSouscription;

    /**
     *
     * @var integer $opt3PTele
     *
     * @ORM\Column(name="OPT_3P_TELE", type="integer", nullable=true)
     */
    private $opt3PTele;

    /**
     *
     * @var string $typeSouscriptionAdsl
     *
     * @ORM\Column(name="TYPE_SOUSCRIPTION_ADSL", type="integer", nullable=true)
     */
    private $typeSouscriptionAdsl;

    /**
     *
     * @var date $dateAttenteActivMobile
     *
     * @ORM\Column(name="DATE_ATTENTE_ACTIV_MOBILE", type="date", nullable=true)
     */
    private $dateAttenteActivMobile;

    /**
     *
     * @var \DateTime $dateDebutResiliation
     *
     * @ORM\Column(name="DATE_DEBUT_RESILIATION", type="date", nullable=true)
     */
    private $dateDebutResiliation;

    /**
     * @param \DateTime $dateDebutResiliation
     */
    public function setDateDebutResiliation($dateDebutResiliation)
    {
        $this->dateDebutResiliation = $dateDebutResiliation;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebutResiliation()
    {
        return $this->dateDebutResiliation;
    }

    /**
     * @param \DateTime $dateEffectiveResiliation
     */
    public function setDateEffectiveResiliation($dateEffectiveResiliation)
    {
        $this->dateEffectiveResiliation = $dateEffectiveResiliation;
    }

    /**
     * @return \DateTime
     */
    public function getDateEffectiveResiliation()
    {
        return $this->dateEffectiveResiliation;
    }

    /**
     *
     * @var \DateTime $dateEffectiveResiliation
     *
     * @ORM\Column(name="DATE_EFFECTIVE_RESILIATION", type="date", nullable=true)
     */
    private $dateEffectiveResiliation;


    /**
     * @ORM\OneToMany(targetEntity="LigneAdsl", mappedBy="contrat")
     * @ORM\JoinColumn(name="ID_CONTRAT", referencedColumnName="ID_CONTRAT")
     */
    private $ligneAdsl;

    /**
     * @return the $client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return the $idContrat
     */
    public function getIdContrat()
    {
        return $this->idContrat;
    }

    /**
     * @return the $contratAnnule
     */
    public function getContratAnnule()
    {
        return $this->contratAnnule;
    }

    /**
     * @return the $dossierRib
     */
    public function getDossierRib()
    {
        return $this->dossierRib;
    }

    /**
     * @return the $fichier
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * @return $typePaiement
     */
    public function getTypePaiement()
    {
        return $this->typePaiement;
    }

    /**
     * @return string
     */
    public function getFilteredTypePaiement()
    {
        return strtr(
            strtolower($this->getTypePaiement()),
            'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ',
            'aaaaaaceeeeiiiinooooouuuuyy'
        );
    }

    /**
     * @return the $depotGarantie
     */
    public function getDepotGarantie()
    {
        return $this->depotGarantie;
    }

    /**
     * @return the $pjCpi
     */
    public function getPjCpi()
    {
        return $this->pjCpi;
    }

    /**
     * @return the $typePjCpi
     */
    public function getTypePjCpi()
    {
        return $this->typePjCpi;
    }

    /**
     * @return the $typePieceCpi
     */
    public function getTypePieceCpi()
    {
        return $this->typePieceCpi;
    }

    /**
     * @return the $pjCa
     */
    public function getPjCa()
    {
        return $this->pjCa;
    }

    /**
     * @return the $pjRib
     */
    public function getPjRib()
    {
        return $this->pjRib;
    }

    /**
     * @return the $pjJd
     */
    public function getPjJd()
    {
        return $this->pjJd;
    }

    /**
     * @return the $pjKbis
     */
    public function getPjKbis()
    {
        return $this->pjKbis;
    }

    /**
     * @return the $pjPrj
     */
    public function getPjPrj()
    {
        return $this->pjPrj;
    }

    /**
     * @return the $pjCb
     */
    public function getPjCb()
    {
        return $this->pjCb;
    }

    /**
     * @return the $pjVip
     */
    public function getPjVip()
    {
        return $this->pjVip;
    }

    /**
     * @return the $cmc7Cheque
     */
    public function getCmc7Cheque()
    {
        return $this->cmc7Cheque;
    }

    /**
     * @return the $optFacture
     */
    public function getOptFacture()
    {
        return $this->optFacture;
    }

    /**
     * @return the $optFactPapier
     */
    public function getOptFactPapier()
    {
        return $this->optFactPapier;
    }

    /**
     * @return the $optBillingElectronique
     */
    public function getOptBillingElectronique()
    {
        return $this->optBillingElectronique;
    }

    /**
     * @return the $optBillingSmsNum
     */
    public function getOptBillingSmsNum()
    {
        return $this->optBillingSmsNum;
    }

    /**
     * @return the $optAnnuaire
     */
    public function getOptAnnuaire()
    {
        return $this->optAnnuaire;
    }

    /**
     * @return the $optAnnuaireCommercial
     */
    public function getOptAnnuaireCommercial()
    {
        return $this->optAnnuaireCommercial;
    }

    /**
     * @return the $optAnnuaireInverse
     */
    public function getOptAnnuaireInverse()
    {
        return $this->optAnnuaireInverse;
    }

    /**
     * @return the $optIllimiteVoix
     */
    public function getOptIllimiteVoix()
    {
        return $this->optIllimiteVoix;
    }

    /**
     * @return the $idCodeVip
     */
    public function getIdCodeVip()
    {
        return $this->idCodeVip;
    }

    /**
     * @return the $dateBilling
     */
    public function getDateBilling()
    {
        return $this->dateBilling;
    }

    /**
     * @return the $toSign
     */
    public function getToSign()
    {
        return $this->toSign;
    }

    /**
     * @return the $pieceType
     */
    public function getPieceType()
    {
        return $this->pieceType;
    }

    /**
     * @return the $pieceId
     */
    public function getPieceId()
    {
        return $this->pieceId;
    }

    /**
     * @return the $clicDate
     */
    public function getClicDate()
    {
        return $this->clicDate;
    }

    /**
     * @return the $clicIp
     */
    public function getClicIp()
    {
        return $this->clicIp;
    }

    /**
     * @return the $statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @return the $pjUsurpid
     */
    public function getPjUsurpid()
    {
        return $this->pjUsurpid;
    }

    /**
     * @return the $statutSouscription
     */
    public function getStatutSouscription()
    {
        return $this->statutSouscription;
    }

    /**
     * @return the $opt3PTele
     */
    public function getOpt3PTele()
    {
        return $this->opt3PTele;
    }

    /**
     * @return the $typeSouscriptionAdsl
     */
    public function getTypeSouscriptionAdsl()
    {
        return $this->typeSouscriptionAdsl;
    }

    /**
     * @return the $dateAttenteActivMobile
     */
    public function getDateAttenteActivMobile()
    {
        return $this->dateAttenteActivMobile;
    }

    /**
     * @return the $ligneAdsl
     */
    public function getLigneAdsl()
    {
        return $this->ligneAdsl;
    }

    /**
     * @param number $idContrat
     */
    public function setIdContrat($idContrat)
    {
        $this->idContrat = $idContrat;
    }

    /**
     * @param \Omea\Entity\Main\date $contratAnnule
     */
    public function setContratAnnule($contratAnnule)
    {
        $this->contratAnnule = $contratAnnule;
    }

    /**
     * @param field_type $dossierRib
     */
    public function setDossierRib($dossierRib)
    {
        $this->dossierRib = $dossierRib;
    }

    /**
     * @param string $fichier
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

    /**
     * @param string $typePaiement
     */
    public function setTypePaiement($typePaiement)
    {
        $this->typePaiement = $typePaiement;
    }

    /**
     * @param \Omea\Entity\Main\decimal $depotGarantie
     */
    public function setDepotGarantie($depotGarantie)
    {
        $this->depotGarantie = $depotGarantie;
    }

    /**
     * @param number $pjCpi
     */
    public function setPjCpi($pjCpi)
    {
        $this->pjCpi = $pjCpi;
    }

    /**
     * @param string $typePjCpi
     */
    public function setTypePjCpi($typePjCpi)
    {
        $this->typePjCpi = $typePjCpi;
    }

    /**
     * @param number $typePieceCpi
     */
    public function setTypePieceCpi($typePieceCpi)
    {
        $this->typePieceCpi = $typePieceCpi;
    }

    /**
     * @param number $pjCa
     */
    public function setPjCa($pjCa)
    {
        $this->pjCa = $pjCa;
    }

    /**
     * @param number $pjRib
     */
    public function setPjRib($pjRib)
    {
        $this->pjRib = $pjRib;
    }

    /**
     * @param number $pjJd
     */
    public function setPjJd($pjJd)
    {
        $this->pjJd = $pjJd;
    }

    /**
     * @param string $pjKbis
     */
    public function setPjKbis($pjKbis)
    {
        $this->pjKbis = $pjKbis;
    }

    /**
     * @param string $pjPrj
     */
    public function setPjPrj($pjPrj)
    {
        $this->pjPrj = $pjPrj;
    }

    /**
     * @param number $pjCb
     */
    public function setPjCb($pjCb)
    {
        $this->pjCb = $pjCb;
    }

    /**
     * @param number $pjVip
     */
    public function setPjVip($pjVip)
    {
        $this->pjVip = $pjVip;
    }

    /**
     * @param string $cmc7Cheque
     */
    public function setCmc7Cheque($cmc7Cheque)
    {
        $this->cmc7Cheque = $cmc7Cheque;
    }

    /**
     * @param number $optFacture
     */
    public function setOptFacture($optFacture)
    {
        $this->optFacture = $optFacture;
    }

    /**
     * @param number $optFactPapier
     */
    public function setOptFactPapier($optFactPapier)
    {
        $this->optFactPapier = $optFactPapier;
    }

    /**
     * @param string $optBillingElectronique
     */
    public function setOptBillingElectronique($optBillingElectronique)
    {
        $this->optBillingElectronique = $optBillingElectronique;
    }

    /**
     * @param string $optBillingSmsNum
     */
    public function setOptBillingSmsNum($optBillingSmsNum)
    {
        $this->optBillingSmsNum = $optBillingSmsNum;
    }

    /**
     * @param number $optAnnuaire
     */
    public function setOptAnnuaire($optAnnuaire)
    {
        $this->optAnnuaire = $optAnnuaire;
    }

    /**
     * @param number $optAnnuaireCommercial
     */
    public function setOptAnnuaireCommercial($optAnnuaireCommercial)
    {
        $this->optAnnuaireCommercial = $optAnnuaireCommercial;
    }

    /**
     * @param number $optAnnuaireInverse
     */
    public function setOptAnnuaireInverse($optAnnuaireInverse)
    {
        $this->optAnnuaireInverse = $optAnnuaireInverse;
    }

    /**
     * @param number $optIllimiteVoix
     */
    public function setOptIllimiteVoix($optIllimiteVoix)
    {
        $this->optIllimiteVoix = $optIllimiteVoix;
    }

    /**
     * @param number $idCodeVip
     */
    public function setIdCodeVip($idCodeVip)
    {
        $this->idCodeVip = $idCodeVip;
    }

    /**
     * @param \Omea\Entity\Main\date $dateBilling
     */
    public function setDateBilling($dateBilling)
    {
        $this->dateBilling = $dateBilling;
    }

    /**
     * @param number $toSign
     */
    public function setToSign($toSign)
    {
        $this->toSign = $toSign;
    }

    /**
     * @param number $pieceType
     */
    public function setPieceType($pieceType)
    {
        $this->pieceType = $pieceType;
    }

    /**
     * @param string $pieceId
     */
    public function setPieceId($pieceId)
    {
        $this->pieceId = $pieceId;
    }

    /**
     * @param \Omea\Entity\Main\datetime $clicDate
     */
    public function setClicDate($clicDate)
    {
        $this->clicDate = $clicDate;
    }

    /**
     * @param string $clicIp
     */
    public function setClicIp($clicIp)
    {
        $this->clicIp = $clicIp;
    }

    /**
     * @param number $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * @param number $pjUsurpid
     */
    public function setPjUsurpid($pjUsurpid)
    {
        $this->pjUsurpid = $pjUsurpid;
    }

    /**
     * @param string $statutSouscription
     */
    public function setStatutSouscription($statutSouscription)
    {
        $this->statutSouscription = $statutSouscription;
    }

    /**
     * @param number $opt3PTele
     */
    public function setOpt3PTele($opt3PTele)
    {
        $this->opt3PTele = $opt3PTele;
    }

    /**
     * @param string $typeSouscriptionAdsl
     */
    public function setTypeSouscriptionAdsl($typeSouscriptionAdsl)
    {
        $this->typeSouscriptionAdsl = $typeSouscriptionAdsl;
    }

    /**
     * @param \Omea\Entity\Main\date $dateAttenteActivMobile
     */
    public function setDateAttenteActivMobile($dateAttenteActivMobile)
    {
        $this->dateAttenteActivMobile = $dateAttenteActivMobile;
    }

    /**
     * @param field_type $ligneAdsl
     */
    public function setLigneAdsl($ligneAdsl)
    {
        $this->ligneAdsl = $ligneAdsl;
    }

}
