<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OT_ADSL")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\OtAdslRepository")
 */
class OtAdsl
{

    /**
     * @var integer $idOc
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $idCmdSfr
     * @ORM\Column(name="ID_CMD_SFR", type="string")
     */
    private $idCmdSfr;

    /**
     * @var integer $idTrans
     * @ORM\Column(name="ID_TRANS", type="integer")
     */
    private $idTrans;

    /**
     * @var LigneAdsl $ligneAdsl
     * @ORM\ManyToOne(targetEntity="LigneAdsl", inversedBy="ligneAdsl")
     * @ORM\JoinColumn(name="ID_LIGNE_ADSL", referencedColumnName = "ID")
     */
    private $ligneAdsl;

    /**
     *
     * @var \DateTime $dateCreation
     *
     * @ORM\Column(name="DATE_CREATION", type="datetime")
     */
    private $dateCreation;

    /**
     *
     * @var \DateTime $planificationFinGel
     *
     * @ORM\Column(name="PLANIFICATION_FIN_GEL", type="datetime")
     */
    private $planificationFinGel;

    /**
     * @var \DateTime $dateEnvoiSFR
     * @ORM\Column(name="DATE_ENVOI_SFR", type="datetime")
     */
    private $dateEnvoiSFR;

    /**
     * @var string $verbe
     * @ORM\Column(name="VERBE", type="string")
     */
    private $verbe;

    /**
     * @var string $statutCode
     * @ORM\Column(name="STATUT_CODE", type="string")
     */
    private $statutCode;

    /**
     * @var string $texteModif
     * @ORM\Column(name="TEXTE_MOTIF", type="string")
     */
    private $texteMotif;

    /**
     * @var \DateTime $dateModification
     * @ORM\Column(name="DATE_MODIFICATION", type="datetime")
     */
    private $dateModification;

    /**
     * @var \integer $demandePorta
     * @ORM\Column(name="DEMANDE_PORTA", type="integer")
     */
    private $demandePorta;

    /**
     * @var integer $activationTv
     * @ORM\Column(name="ACTIVATION_TV", type="integer")
     */
    private $activationTv;

    /**
     * @var integer $activationVoIP
     * @ORM\Column(name="ACTIVATION_VOIP", type="integer")
     */
    private $activationVoIP;

    /**
     * @var integer $activationInternet
     * @ORM\Column(name="ACTIVATION_INTERNET", type="integer")
     */
    private $activationInternet;

    /**
     * @var string $statutArfic
     * @ORM\Column(name="STATUT_ARFIC", type="string", nullable=false)
     */
    private $statutArfic = "NON_RECU";

    /**
     * @var string $statutArcmd
     * @ORM\Column(name="STATUT_ARCMD", type="string")
     */
    private $statutArcmd = "NON_RECU";

    /**
     * @var string $statutNob
     * @ORM\Column(name="STATUT_NOB", type="string")
     */
    private $statutNob = "NON_RECU";

    /**
     * @var string $statutNor
     * @ORM\Column(name="STATUT_NOR", type="string")
     */
    private $statutNor = "NON_RECU";

    /**
     * @var string $statutCrcmd
     * @ORM\Column(name="STATUT_CRCMD", type="string")
     */
    private $statutCrcmd = "NON_RECU";

    /**
     * @var string $statutNoe
     * @ORM\Column(name="STATUT_NOE", type="string")
     */
    private $statutNoe = "NON_RECU";

    /**
     * @var string $statutNop
     * @ORM\Column(name="STATUT_NOP", type="string")
     */
    private $statutNop = "NON_RECU";

    /**
     * @var string $statutNos
     * @ORM\Column(name="STATUT_NOS", type="string")
     */
    private $statutNos = "NON_RECU";

    /**
     * @var string $statutNhd
     * @ORM\Column(name="STATUT_NHD", type="string")
     */
    private $statutNhd = "NON_RECU";

    /**
     * @var string $statutFactuCode
     * @ORM\Column(name="STATUT_FACTU_CODE", type="string")
     */
    private $statutFactuCode;

    /**
     * @var string $statutFactuMessage
     * @ORM\Column(name="STATUT_FACTU_MESSAGE", type="string")
     */
    private $statutFactuMessage;

    /**
     * @var string $statutCourrierCode
     * @ORM\Column(name="STATUT_COURRIER_CODE", type="string")
     */
    private $statutCourrierCode;

    /**
     * @var string $statutCourrierMessage
     * @ORM\Column(name="STATUT_COURRIER_MESSAGE", type="string")
     */
    private $statutCourrierMessage;

    /**
     * @var \DateTime $dateButRestitutionEqpt
     * @ORM\Column(name="DATE_BUT_RESTITUTION_EQPT", type="datetime")
     */
    private $dateButRestitutionEqpt;

    /**
     * @var \DateTime $dateButRelanceRetourEqpt
     * @ORM\Column(name="DATE_BUT_RELANCE_RETOUR_EQPT", type="datetime")
     */
    private $dateButRelanceRetourEqpt;

    /**
     * @var \DateTime $dateButResiliationAtteRetourSfr
     * @ORM\Column(name="DATE_BUT_RESILIATION_ATTE_RETOUR_SFR", type="datetime")
     */
    private $dateButResiliationAtteRetourSfr;

    /**
     * @var string $statutRelanceRetourEqpt
     * @ORM\Column(name="STATUT_RELANCE_RETOUR_EQPT", type="string")
     */
    private $statutRelanceRetourEqpt;

    /**
     * @var float $montantFactureStb
     * @ORM\Column(name="MONTANT_FACTURE_STB", type="decimal")
     */
    private $montantFactureStb;

    /**
     * @var float $montantFactureIad
     * @ORM\Column(name="MONTANT_FACTURE_IAD", type="decimal")
     */
    private $montantFactureIad;

    /**
     * @var int $dateAnonBanque
     * @ORM\Column(name="DATE_ANON_BANQUE", type="integer")
     */
    private $dateAnonBanque;

    /**
     * @var float $montantFactureOtt
     * @ORM\Column(name="MONTANT_FACTURE_OTT", type="decimal")
     */
    private $montantFactureOtt;

    /**
     * @param int $activationInternet
     */
    public function setActivationInternet($activationInternet)
    {
        $this->activationInternet = $activationInternet;
    }

    /**
     * @return int
     */
    public function getActivationInternet()
    {
        return $this->activationInternet;
    }

    /**
     * @param int $activationTv
     */
    public function setActivationTv($activationTv)
    {
        $this->activationTv = $activationTv;
    }

    /**
     * @return int
     */
    public function getActivationTv()
    {
        return $this->activationTv;
    }

    /**
     * @param int $activationVoIP
     */
    public function setActivationVoIP($activationVoIP)
    {
        $this->activationVoIP = $activationVoIP;
    }

    /**
     * @return int
     */
    public function getActivationVoIP()
    {
        return $this->activationVoIP;
    }

    /**
     * @param int $dateAnonBanque
     */
    public function setDateAnonBanque($dateAnonBanque)
    {
        $this->dateAnonBanque = $dateAnonBanque;
    }

    /**
     * @return int
     */
    public function getDateAnonBanque()
    {
        return $this->dateAnonBanque;
    }

    /**
     * @param \DateTime $dateButRelanceRetourEqpt
     */
    public function setDateButRelanceRetourEqpt($dateButRelanceRetourEqpt)
    {
        $this->dateButRelanceRetourEqpt = $dateButRelanceRetourEqpt;
    }

    /**
     * @return \DateTime
     */
    public function getDateButRelanceRetourEqpt()
    {
        return $this->dateButRelanceRetourEqpt;
    }

    /**
     * @param \DateTime $dateButResiliationAtteRetourSfr
     */
    public function setDateButResiliationAtteRetourSfr($dateButResiliationAtteRetourSfr)
    {
        $this->dateButResiliationAtteRetourSfr = $dateButResiliationAtteRetourSfr;
    }

    /**
     * @return \DateTime
     */
    public function getDateButResiliationAtteRetourSfr()
    {
        return $this->dateButResiliationAtteRetourSfr;
    }

    /**
     * @param \DateTime $dateButRestitutionEqpt
     */
    public function setDateButRestitutionEqpt($dateButRestitutionEqpt)
    {
        $this->dateButRestitutionEqpt = $dateButRestitutionEqpt;
    }

    /**
     * @return \DateTime
     */
    public function getDateButRestitutionEqpt()
    {
        return $this->dateButRestitutionEqpt;
    }

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
     * @param \DateTime $dateEnvoiSFR
     */
    public function setDateEnvoiSFR($dateEnvoiSFR)
    {
        $this->dateEnvoiSFR = $dateEnvoiSFR;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnvoiSFR()
    {
        return $this->dateEnvoiSFR;
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
     * @param int $demandePorta
     */
    public function setDemandePorta($demandePorta)
    {
        $this->demandePorta = $demandePorta;
    }

    /**
     * @return int
     */
    public function getDemandePorta()
    {
        return $this->demandePorta;
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
     * @param string $idCmdSfr
     */
    public function setIdCmdSfr($idCmdSfr)
    {
        $this->idCmdSfr = $idCmdSfr;
    }

    /**
     * @return string
     */
    public function getIdCmdSfr()
    {
        return $this->idCmdSfr;
    }

    /**
     * @param int $idTrans
     */
    public function setIdTrans($idTrans)
    {
        $this->idTrans = $idTrans;
    }

    /**
     * @return int
     */
    public function getIdTrans()
    {
        return $this->idTrans;
    }

    /**
     * @param mixed $ligneAdsl
     */
    public function setLigneAdsl($ligneAdsl)
    {
        $this->ligneAdsl = $ligneAdsl;
    }

    /**
     * @return mixed
     */
    public function getLigneAdsl()
    {
        return $this->ligneAdsl;
    }

    /**
     * @param float $montantFactureIad
     */
    public function setMontantFactureIad($montantFactureIad)
    {
        $this->montantFactureIad = $montantFactureIad;
    }

    /**
     * @return float
     */
    public function getMontantFactureIad()
    {
        return $this->montantFactureIad;
    }

    /**
     * @param float $montantFactureOtt
     */
    public function setMontantFactureOtt($montantFactureOtt)
    {
        $this->montantFactureOtt = $montantFactureOtt;
    }

    /**
     * @return float
     */
    public function getMontantFactureOtt()
    {
        return $this->montantFactureOtt;
    }

    /**
     * @param float $montantFactureStb
     */
    public function setMontantFactureStb($montantFactureStb)
    {
        $this->montantFactureStb = $montantFactureStb;
    }

    /**
     * @return float
     */
    public function getMontantFactureStb()
    {
        return $this->montantFactureStb;
    }

    /**
     * @param \DateTime $planificationFinGel
     */
    public function setPlanificationFinGel($planificationFinGel)
    {
        $this->planificationFinGel = $planificationFinGel;
    }

    /**
     * @return \DateTime
     */
    public function getPlanificationFinGel()
    {
        return $this->planificationFinGel;
    }

    /**
     * @param string $statutArcmd
     */
    public function setStatutArcmd($statutArcmd)
    {
        $this->statutArcmd = $statutArcmd;
    }

    /**
     * @return string
     */
    public function getStatutArcmd()
    {
        return $this->statutArcmd;
    }

    /**
     * @param string $statutArfic
     */
    public function setStatutArfic($statutArfic)
    {
        $this->statutArfic = $statutArfic;
    }

    /**
     * @return string
     */
    public function getStatutArfic()
    {
        return $this->statutArfic;
    }

    /**
     * @param string $statutCode
     */
    public function setStatutCode($statutCode)
    {
        $this->statutCode = $statutCode;
    }

    /**
     * @return string
     */
    public function getStatutCode()
    {
        return $this->statutCode;
    }

    /**
     * @param string $statutCourrierCode
     */
    public function setStatutCourrierCode($statutCourrierCode)
    {
        $this->statutCourrierCode = $statutCourrierCode;
    }

    /**
     * @return string
     */
    public function getStatutCourrierCode()
    {
        return $this->statutCourrierCode;
    }

    /**
     * @param string $statutCourrierMessage
     */
    public function setStatutCourrierMessage($statutCourrierMessage)
    {
        $this->statutCourrierMessage = $statutCourrierMessage;
    }

    /**
     * @return string
     */
    public function getStatutCourrierMessage()
    {
        return $this->statutCourrierMessage;
    }

    /**
     * @param string $statutCrcmd
     */
    public function setStatutCrcmd($statutCrcmd)
    {
        $this->statutCrcmd = $statutCrcmd;
    }

    /**
     * @return string
     */
    public function getStatutCrcmd()
    {
        return $this->statutCrcmd;
    }

    /**
     * @param string $statutFactuCode
     */
    public function setStatutFactuCode($statutFactuCode)
    {
        $this->statutFactuCode = $statutFactuCode;
    }

    /**
     * @return string
     */
    public function getStatutFactuCode()
    {
        return $this->statutFactuCode;
    }

    /**
     * @param string $statutFactuMessage
     */
    public function setStatutFactuMessage($statutFactuMessage)
    {
        $this->statutFactuMessage = $statutFactuMessage;
    }

    /**
     * @return string
     */
    public function getStatutFactuMessage()
    {
        return $this->statutFactuMessage;
    }

    /**
     * @param string $statutNhd
     */
    public function setStatutNhd($statutNhd)
    {
        $this->statutNhd = $statutNhd;
    }

    /**
     * @return string
     */
    public function getStatutNhd()
    {
        return $this->statutNhd;
    }

    /**
     * @param string $statutNob
     */
    public function setStatutNob($statutNob)
    {
        $this->statutNob = $statutNob;
    }

    /**
     * @return string
     */
    public function getStatutNob()
    {
        return $this->statutNob;
    }

    /**
     * @param string $statutNoe
     */
    public function setStatutNoe($statutNoe)
    {
        $this->statutNoe = $statutNoe;
    }

    /**
     * @return string
     */
    public function getStatutNoe()
    {
        return $this->statutNoe;
    }

    /**
     * @param string $statutNop
     */
    public function setStatutNop($statutNop)
    {
        $this->statutNop = $statutNop;
    }

    /**
     * @return string
     */
    public function getStatutNop()
    {
        return $this->statutNop;
    }

    /**
     * @param string $statutNor
     */
    public function setStatutNor($statutNor)
    {
        $this->statutNor = $statutNor;
    }

    /**
     * @return string
     */
    public function getStatutNor()
    {
        return $this->statutNor;
    }

    /**
     * @param string $statutNos
     */
    public function setStatutNos($statutNos)
    {
        $this->statutNos = $statutNos;
    }

    /**
     * @return string
     */
    public function getStatutNos()
    {
        return $this->statutNos;
    }

    /**
     * @param string $statutRelanceRetourEqpt
     */
    public function setStatutRelanceRetourEqpt($statutRelanceRetourEqpt)
    {
        $this->statutRelanceRetourEqpt = $statutRelanceRetourEqpt;
    }

    /**
     * @return string
     */
    public function getStatutRelanceRetourEqpt()
    {
        return $this->statutRelanceRetourEqpt;
    }

    /**
     * @param string $texteModif
     */
    public function setTexteMotif($texteModif)
    {
        $this->texteMotif = $texteModif;
    }

    /**
     * @return string
     */
    public function getTexteMotif()
    {
        return $this->texteMotif;
    }

    /**
     * @param string $verbe
     */
    public function setVerbe($verbe)
    {
        $this->verbe = $verbe;
    }

    /**
     * @return string
     */
    public function getVerbe()
    {
        return $this->verbe;
    }
}
