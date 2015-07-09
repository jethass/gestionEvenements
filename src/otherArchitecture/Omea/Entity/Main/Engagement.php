<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ENGAGEMENTS")
 * @ORM\Entity
 */
class Engagement
{
    /**
     *
     * @var integer $idEngagement
     *
     * @ORM\Column(name="ID_ENGAGEMENT", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idEngagement;

    /**
     *
     * @var integer $idClient
     * @ORM\Column(name="ID_CLIENT", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var date $dateDebut
     * @ORM\Column(name="DATE_DEBUT", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var date $dateFin
     * @ORM\Column(name="DATE_FIN", type="date", nullable=false)
     */
    private $dateFin;

    /**
     * @var string $duree
     * @ORM\Column(name="DUREE", type="string", length=2, nullable=false)
     */
    private $duree;

    /**
     * @var string $motif
     * @ORM\Column(name="MOTIF", type="string", length=5, nullable=false)
     */
    private $motif;

    /**
     * @var string $etat
     * @ORM\Column(name="ETAT", type="string", length=1, nullable=false)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="engagements")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT", nullable=false)
     */
    private $client;

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param string $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param int $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @return int
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param int $idEngagement
     */
    public function setIdEngagement($idEngagement)
    {
        $this->idEngagement = $idEngagement;
    }

    /**
     * @return int
     */
    public function getIdEngagement()
    {
        return $this->idEngagement;
    }

    /**
     * @param string $motif
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;
    }

    /**
     * @return string
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return StockMsisdn
     */
    public function getStockmsisdn()
    {
        if (!$this->getClient()) {
            return;
        }

        return $this->getClient()->getStockMsisdn()->first();
    }
}
