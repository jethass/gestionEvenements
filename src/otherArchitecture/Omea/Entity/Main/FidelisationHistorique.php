<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FIDELISATION_HISTORIQUE")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\FidelisationHistoriqueRepository")
 */
class FidelisationHistorique
{

    /**
     *
     * @var integer $idfhis
     *
     * @ORM\Column(name="IDFHIS", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfhis;

    /**
     *
     * @var integer $prixAchatHt
     * @ORM\Column(name="PRIXACHATHT", type="decimal", nullable=false)
     */
    private $prixAchatHt;

    /**
     *
     * @var integer $prixFidHt
     * @ORM\Column(name="PRIXFIDHT", type="decimal", nullable=false)
     */
    private $prixFidHt;

    /**
     *
     * @var integer $subventionHt
     * @ORM\Column(name="SUBVENTIONHT", type="decimal", nullable=false)
     */
    private $subventionHt;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT")
     */
    private $client;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CLIENT", type="string", length=255)
     */
    private $idClient;

    /**
     *
     * @var integer $points
     * @ORM\Column(name="POINTS", type="bigint", nullable=false)
     */
    private $points;

    /**
     *
     * @var string $engagement
     * @ORM\Column(name="ENGAGEMENT", type="string", nullable=false)
     */
    private $engagement;

    /**
     *
     * @var string $idBonus
     * @ORM\Column(name="ID_BONUS", type="bigint")
     */
    private $idBonus;

    /**
     * @var date $dateHistorisation
     * @ORM\Column(name="DATEHISTORISATION", type="date")
     */
    private $dateHistorisation;

    /**
     * @var date $dateRetractation
     * @ORM\Column(name="DATERETRACTATION", type="date")
     */
    private $dateRetractation;

    /**
     * @var date $dateEngagement
     * @ORM\Column(name="DATEENGAGEMENT", type="date")
     */
    private $dateEngagement;

    /**
     * @var date $dateResiliation
     * @ORM\Column(name="DATERESILIATION", type="date")
     */
    private $dateResiliation;

    /**
     *
     * @var string $typeFidelisation
     * @ORM\Column(name="TYPEFIDELISATION", type="string", length=10)
     */
    private $typeFidelisation;

    /**
     *
     * @var string $modePaiement
     * @ORM\Column(name="MODEPAIEMENT", type="string", length=10)
     */
    private $modePaiement;

    /**
     * @var datetime $dateDernMaj
     * @ORM\Column(name="DATE_DERN_MAJ", type="datetime", nullable = false)
     */
    private $dateDernMaj;

    /**
     *
     * @var integer $idConseiller
     * @ORM\Column(name="ID_CONSEILLER", type="integer", length=6)
     */
    private $idConseiller;

    /**
     *
     * @var integer $idSite
     * @ORM\Column(name="ID_SITE", type="integer", length=2)
     */
    private $idSite;

    /**
     *
     * @var string $typeOffreLibelle
     * @ORM\Column(name="TYPE_OFFRE_LIBELLE", type="string", length=250)
     */
    private $typeOffreLibelle;

    /**
     *
     * @var integer $idFideClientHistorique
     * @ORM\Column(name="ID_FIDE_CLIENT_HISTORIQUE", type="integer")
     */
    private $idFideClientHistorique;

    /**
     *
     * @var integer $idFideOldPopulation
     * @ORM\Column(name="ID_FIDE_OLD_POPULATION", type="integer")
     */
    private $idFideOldPopulation;

    /**
     *
     * @var integer $delie
     * @ORM\Column(name="DELIE", type="integer", length=4, nullable=false)
     */
    private $delie;

    /**
     *
     * @var decimal $prixCessionHt
     * @ORM\Column(name="PRIXCESSIONHT", type="decimal")
     */
    private $prixCessionHt;

    /**
     *
     * @var string $remajust
     * @ORM\Column(name="REMAJUST", type="string", length=20)
     */
    private $remajust;

    /**
     *
     * @var integer $idDis
     * @ORM\Column(name="ID_DIS", type="integer", length=5)
     */
    private $idDis;

    /**
     *
     * @var integer $idMag
     * @ORM\Column(name="ID_MAG", type="integer", length=8)
     */
    private $idMag;

    /**
     *
     * @var integer $idMotif
     * @ORM\Column(name="ID_MOTIF", type="integer", length=6)
     */
    private $idMotif;

    /**
     *
     * @var integer $idDisRetractation
     * @ORM\Column(name="ID_DIS_RETRACTATION", type="integer", length=5)
     */
    private $idDisRetractation;

    /**
     *
     * @var integer $idMagRetractation
     * @ORM\Column(name="ID_MAG_RETRACTATION", type="integer", length=8)
     */
    private $idMagRetractation;

    /**
     *
     * @var integer $isSursub
     * @ORM\Column(name="IS_SURSUB", type="integer", length=3)
     */
    private $isSursub;

    /**
     *
     * @var decimal $montantSursub
     * @ORM\Column(name="MONTANT_SURSUB", type="decimal")
     */
    private $montantSursub;

    /**
     *
     * @var integer $idCanal
     * @ORM\Column(name="ID_CANAL", type="integer", length=5)
     */
    private $idCanal;

    /**
     * @ORM\OneToOne(targetEntity="Transaction")
     * @ORM\JoinColumn(name="IDFHIS", referencedColumnName="IDFHIS")
     */
    private $transaction;

    /**
     *
     * @var integer $idMig
     * @ORM\Column(name="ID_MIG", type="bigint")
     */
    private $idMig;

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
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \Omea\Entity\Main\datetime $dateDernMaj
     */
    public function setDateDernMaj($dateDernMaj)
    {
        $this->dateDernMaj = $dateDernMaj;
    }

    /**
     * @return \Omea\Entity\Main\datetime
     */
    public function getDateDernMaj()
    {
        return $this->dateDernMaj;
    }

    /**
     * @param \Omea\Entity\Main\date $dateEngagement
     */
    public function setDateEngagement($dateEngagement)
    {
        $this->dateEngagement = $dateEngagement;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateEngagement()
    {
        return $this->dateEngagement;
    }

    /**
     * @param \Omea\Entity\Main\date $dateHistorisation
     */
    public function setDateHistorisation($dateHistorisation)
    {
        $this->dateHistorisation = $dateHistorisation;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateHistorisation()
    {
        return $this->dateHistorisation;
    }

    /**
     * @param \Omea\Entity\Main\date $dateResiliation
     */
    public function setDateResiliation($dateResiliation)
    {
        $this->dateResiliation = $dateResiliation;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateResiliation()
    {
        return $this->dateResiliation;
    }

    /**
     * @param \Omea\Entity\Main\date $dateRetractation
     */
    public function setDateRetractation($dateRetractation)
    {
        $this->dateRetractation = $dateRetractation;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateRetractation()
    {
        return $this->dateRetractation;
    }

    /**
     * @param int $delie
     */
    public function setDelie($delie)
    {
        $this->delie = $delie;
    }

    /**
     * @return int
     */
    public function getDelie()
    {
        return $this->delie;
    }

    /**
     * @param string $engagement
     */
    public function setEngagement($engagement)
    {
        $this->engagement = $engagement;
    }

    /**
     * @return string
     */
    public function getEngagement()
    {
        return $this->engagement;
    }

    /**
     * @param string $idBonus
     */
    public function setIdBonus($idBonus)
    {
        $this->idBonus = $idBonus;
    }

    /**
     * @return string
     */
    public function getIdBonus()
    {
        return $this->idBonus;
    }

    /**
     * @param int $idCanal
     */
    public function setIdCanal($idCanal)
    {
        $this->idCanal = $idCanal;
    }

    /**
     * @return int
     */
    public function getIdCanal()
    {
        return $this->idCanal;
    }

    /**
     * @param int $idConseiller
     */
    public function setIdConseiller($idConseiller)
    {
        $this->idConseiller = $idConseiller;
    }

    /**
     * @return int
     */
    public function getIdConseiller()
    {
        return $this->idConseiller;
    }

    /**
     * @param int $idDis
     */
    public function setIdDis($idDis)
    {
        $this->idDis = $idDis;
    }

    /**
     * @return int
     */
    public function getIdDis()
    {
        return $this->idDis;
    }

    /**
     * @param int $idDisRetractation
     */
    public function setIdDisRetractation($idDisRetractation)
    {
        $this->idDisRetractation = $idDisRetractation;
    }

    /**
     * @return int
     */
    public function getIdDisRetractation()
    {
        return $this->idDisRetractation;
    }

    /**
     * @param int $idFideClientHistorique
     */
    public function setIdFideClientHistorique($idFideClientHistorique)
    {
        $this->idFideClientHistorique = $idFideClientHistorique;
    }

    /**
     * @return int
     */
    public function getIdFideClientHistorique()
    {
        return $this->idFideClientHistorique;
    }

    /**
     * @param int $idFideOldPopulation
     */
    public function setIdFideOldPopulation($idFideOldPopulation)
    {
        $this->idFideOldPopulation = $idFideOldPopulation;
    }

    /**
     * @return int
     */
    public function getIdFideOldPopulation()
    {
        return $this->idFideOldPopulation;
    }

    /**
     * @param int $idMag
     */
    public function setIdMag($idMag)
    {
        $this->idMag = $idMag;
    }

    /**
     * @return int
     */
    public function getIdMag()
    {
        return $this->idMag;
    }

    /**
     * @param int $idMagRetractation
     */
    public function setIdMagRetractation($idMagRetractation)
    {
        $this->idMagRetractation = $idMagRetractation;
    }

    /**
     * @return int
     */
    public function getIdMagRetractation()
    {
        return $this->idMagRetractation;
    }

    /**
     * @param int $idMig
     */
    public function setIdMig($idMig)
    {
        $this->idMig = $idMig;
    }

    /**
     * @return int
     */
    public function getIdMig()
    {
        return $this->idMig;
    }

    /**
     * @param int $idMotif
     */
    public function setIdMotif($idMotif)
    {
        $this->idMotif = $idMotif;
    }

    /**
     * @return int
     */
    public function getIdMotif()
    {
        return $this->idMotif;
    }

    /**
     * @param int $idSite
     */
    public function setIdSite($idSite)
    {
        $this->idSite = $idSite;
    }

    /**
     * @return int
     */
    public function getIdSite()
    {
        return $this->idSite;
    }

    /**
     * @param int $isSursub
     */
    public function setIsSursub($isSursub)
    {
        $this->isSursub = $isSursub;
    }

    /**
     * @return int
     */
    public function getIsSursub()
    {
        return $this->isSursub;
    }

    /**
     * @param int $idfhis
     */
    public function setIdfhis($idfhis)
    {
        $this->idfhis = $idfhis;
    }

    /**
     * @return int
     */
    public function getIdfhis()
    {
        return $this->idfhis;
    }

    /**
     * @param string $modePaiement
     */
    public function setModePaiement($modePaiement)
    {
        $this->modePaiement = $modePaiement;
    }

    /**
     * @return string
     */
    public function getModePaiement()
    {
        return $this->modePaiement;
    }

    /**
     * @param \Omea\Entity\Main\decimal $montantSursub
     */
    public function setMontantSursub($montantSursub)
    {
        $this->montantSursub = $montantSursub;
    }

    /**
     * @return \Omea\Entity\Main\decimal
     */
    public function getMontantSursub()
    {
        return $this->montantSursub;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $prixAchatHt
     */
    public function setPrixAchatHt($prixAchatHt)
    {
        $this->prixAchatHt = $prixAchatHt;
    }

    /**
     * @return int
     */
    public function getPrixAchatHt()
    {
        return $this->prixAchatHt;
    }

    /**
     * @param \Omea\Entity\Main\decimal $prixCessionHt
     */
    public function setPrixCessionHt($prixCessionHt)
    {
        $this->prixCessionHt = $prixCessionHt;
    }

    /**
     * @return \Omea\Entity\Main\decimal
     */
    public function getPrixCessionHt()
    {
        return $this->prixCessionHt;
    }

    /**
     * @param int $prixFidHt
     */
    public function setPrixFidHt($prixFidHt)
    {
        $this->prixFidHt = $prixFidHt;
    }

    /**
     * @return int
     */
    public function getPrixFidHt()
    {
        return $this->prixFidHt;
    }

    /**
     * @param string $remajust
     */
    public function setRemajust($remajust)
    {
        $this->remajust = $remajust;
    }

    /**
     * @return string
     */
    public function getRemajust()
    {
        return $this->remajust;
    }

    /**
     * @param int $subventionHt
     */
    public function setSubventionHt($subventionHt)
    {
        $this->subventionHt = $subventionHt;
    }

    /**
     * @return int
     */
    public function getSubventionHt()
    {
        return $this->subventionHt;
    }

    /**
     * @param string $typeFidelisation
     */
    public function setTypeFidelisation($typeFidelisation)
    {
        $this->typeFidelisation = $typeFidelisation;
    }

    /**
     * @return string
     */
    public function getTypeFidelisation()
    {
        return $this->typeFidelisation;
    }

    /**
     * @param string $typeOffreLibelle
     */
    public function setTypeOffreLibelle($typeOffreLibelle)
    {
        $this->typeOffreLibelle = $typeOffreLibelle;
    }

    /**
     * @return string
     */
    public function getTypeOffreLibelle()
    {
        return $this->typeOffreLibelle;
    }

    /**
     * @param mixed $transaction
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

}