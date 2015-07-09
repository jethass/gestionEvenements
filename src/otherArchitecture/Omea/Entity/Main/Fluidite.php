<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FLUIDITE")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\FluiditeRepository")
 */
class Fluidite
{

    /**
     *
     * @var integer $idMig
     *
     * @ORM\Column(name="ID_MIG", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idMig;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT")
     */
    private $client;

    /**
     * @var integer
     *
     * @ORM\Column(name="OFFRE_ID", type="integer", nullable=false)
     */
    private $offreId = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Forfait")
     * @ORM\JoinColumn(name="OFFRE_ID", referencedColumnName="offre_id")
     */
    private $forfait;

    /**
     * @var integer
     *
     * @ORM\Column(name="offre_old", type="integer")
     */
    private $offreOld;

    /**
     * @var date $dateMigration
     * @ORM\Column(name="DATE_MIGRATION", type="date", nullable=false)
     */
    private $dateMigration;

    /**
     * @var date $dateAnnulation
     * @ORM\Column(name="DATE_ANNULATION", type="date", nullable=false)
     */
    private $dateAnnulation;

    /**
     *
     * @var integer $fichierSisteer
     * @ORM\Column(name="FICHIER_SISTEER", type="string", length=100)
     */
    private $fichierSisteer;

    /**
     *
     * @var integer $ackOrange
     * @ORM\Column(name="ACK_ORANGE", type="integer")
     */
    private $ackOrange;

    /**
     * @var \DateTime $dateInsertion
     * @ORM\Column(name="date_insertion", type="datetime")
     */
    private $dateInsertion;

    /**
     * @var date $finAboCourant
     * @ORM\Column(name="FIN_ABO_COURANT", type="date")
     */
    private $finAboCourant;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CONSEILLER", type="integer", nullable=false)
     */
    private $idConseiller;

    /**
     *
     * @var date $traite
     * @ORM\Column(name="TRAITE", type="date")
     */
    private $traite;

    /**
     * @ORM\ManyToOne(targetEntity="StockMsisdn")
     * @ORM\JoinColumn(name="MSISDN", referencedColumnName="MSISDN")
     */
    private $stockMsisdn;

    /**
     *
     * @var string $opt
     * @ORM\Column(name="opt", type="string", length=1)
     */
    private $opt;

    /**
     *
     * @var string $oldOpt
     * @ORM\Column(name="old_opt", type="string", length=1)
     */
    private $oldOpt;

    /**
     *
     * @var string $cycle
     * @ORM\Column(name="CYCLE", type="string", length=2)
     */
    private $cycle;

    /**
     *
     * @var string $codeComptable
     * @ORM\Column(name="CODE_COMPTABLE", type="string", length=3)
     */
    private $codeComptable;

    /**
     *
     * @var float $montant
     *
     * @ORM\Column(name="MONTANT", type="float")
     */
    private $montant;

    /**
     *
     * @var string $ip
     * @ORM\Column(name="IP", type="string", length=15)
     */
    private $ip;

    /**
     *
     * @var string $refusEngagement
     * @ORM\Column(name="REFUS_ENGAGEMENT", type="integer", nullable=false)
     */
    private $refusEngagement = 0;

    /**
     *
     * @var string $idTraitementmicZsmart
     * @ORM\Column(name="ID_TRAITEMENTMIC_ZSMART", type="integer")
     */
    private $idTraitementmicZsmart;

    /**
     *
     * @var string $dureeEngagement
     * @ORM\Column(name="DUREE_ENGAGEMENT", type="integer")
     */
    private $dureeEngagement;

    /**
     *
     * @var string $codeCanal
     * @ORM\Column(name="CODE_CANAL", type="string", length=245)
     */
    private $codeCanal;

    /**
     *
     * @var string $idAcceptation
     * @ORM\Column(name="ID_ACCEPTATION", type="integer")
     */
    private $idAcceptation;

    /**
     * @param int $ackOrange
     */
    public function setAckOrange($ackOrange)
    {
        $this->ackOrange = $ackOrange;
    }

    /**
     * @return int
     */
    public function getAckOrange()
    {
        return $this->ackOrange;
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
     * @param string $codeCanal
     */
    public function setCodeCanal($codeCanal)
    {
        $this->codeCanal = $codeCanal;
    }

    /**
     * @return string
     */
    public function getCodeCanal()
    {
        return $this->codeCanal;
    }

    /**
     * @param string $codeComptable
     */
    public function setCodeComptable($codeComptable)
    {
        $this->codeComptable = $codeComptable;
    }

    /**
     * @return string
     */
    public function getCodeComptable()
    {
        return $this->codeComptable;
    }

    /**
     * @param string $cycle
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;
    }

    /**
     * @return string
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * @param \Omea\Entity\Main\date $dateAnnulation
     */
    public function setDateAnnulation($dateAnnulation)
    {
        $this->dateAnnulation = $dateAnnulation;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateAnnulation()
    {
        return $this->dateAnnulation;
    }

    /**
     * @param \DateTime $dateInsertion
     */
    public function setDateInsertion($dateInsertion)
    {
        $this->dateInsertion = $dateInsertion;
    }

    /**
     * @return \DateTime
     */
    public function getDateInsertion()
    {
        return $this->dateInsertion;
    }

    /**
     * @param \Omea\Entity\Main\date $dateMigration
     */
    public function setDateMigration($dateMigration)
    {
        $this->dateMigration = $dateMigration;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateMigration()
    {
        return $this->dateMigration;
    }

    /**
     * @param string $dureeEngagement
     */
    public function setDureeEngagement($dureeEngagement)
    {
        $this->dureeEngagement = $dureeEngagement;
    }

    /**
     * @return string
     */
    public function getDureeEngagement()
    {
        return $this->dureeEngagement;
    }

    /**
     * @param int $fichierSisteer
     */
    public function setFichierSisteer($fichierSisteer)
    {
        $this->fichierSisteer = $fichierSisteer;
    }

    /**
     * @return int
     */
    public function getFichierSisteer()
    {
        return $this->fichierSisteer;
    }

    /**
     * @param \Omea\Entity\Main\date $finAboCourant
     */
    public function setFinAboCourant($finAboCourant)
    {
        $this->finAboCourant = $finAboCourant;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getFinAboCourant()
    {
        return $this->finAboCourant;
    }

    /**
     * @param string $idAcceptation
     */
    public function setIdAcceptation($idAcceptation)
    {
        $this->idAcceptation = $idAcceptation;
    }

    /**
     * @return string
     */
    public function getIdAcceptation()
    {
        return $this->idAcceptation;
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
     * @param string $idTraitementmicZsmart
     */
    public function setIdTraitementmicZsmart($idTraitementmicZsmart)
    {
        $this->idTraitementmicZsmart = $idTraitementmicZsmart;
    }

    /**
     * @return string
     */
    public function getIdTraitementmicZsmart()
    {
        return $this->idTraitementmicZsmart;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param float $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param int $offreId
     */
    public function setOffreId($offreId)
    {
        $this->offreId = $offreId;
    }

    /**
     * @return int
     */
    public function getOffreId()
    {
        return $this->offreId;
    }

    /**
     * @param int $offreOld
     */
    public function setOffreOld($offreOld)
    {
        $this->offreOld = $offreOld;
    }

    /**
     * @return int
     */
    public function getOffreOld()
    {
        return $this->offreOld;
    }

    /**
     * @param string $oldOpt
     */
    public function setOldOpt($oldOpt)
    {
        $this->oldOpt = $oldOpt;
    }

    /**
     * @return string
     */
    public function getOldOpt()
    {
        return $this->oldOpt;
    }

    /**
     * @param string $opt
     */
    public function setOpt($opt)
    {
        $this->opt = $opt;
    }

    /**
     * @return string
     */
    public function getOpt()
    {
        return $this->opt;
    }

    /**
     * @param string $refusEngagement
     */
    public function setRefusEngagement($refusEngagement)
    {
        $this->refusEngagement = $refusEngagement;
    }

    /**
     * @return string
     */
    public function getRefusEngagement()
    {
        return $this->refusEngagement;
    }

    /**
     * @param mixed $stockMsisdn
     */
    public function setStockMsisdn($stockMsisdn)
    {
        $this->stockMsisdn = $stockMsisdn;
    }

    /**
     * @return mixed
     */
    public function getStockMsisdn()
    {
        return $this->stockMsisdn;
    }

    /**
     * @param \Omea\Entity\Main\date $traite
     */
    public function setTraite($traite)
    {
        $this->traite = $traite;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getTraite()
    {
        return $this->traite;
    }

    /**
     * @param mixed $forfait
     */
    public function setForfait($forfait)
    {
        $this->forfait = $forfait;
    }

    /**
     * @return mixed
     */
    public function getForfait()
    {
        return $this->forfait;
    }
}
