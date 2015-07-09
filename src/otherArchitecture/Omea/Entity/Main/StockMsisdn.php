<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="STOCK_MSISDN")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\StockMsisdnRepository")
 */
class StockMsisdn
{

    /**
     * Recupere le champ en string
     * Illogique de traiter un msisdn en entier
     *
     * @ORM\Column(name="MSISDN", type="string")
     * @ORM\Id
     */
    private $msisdn;

    /**
     *
     * @var integer $idArt
     * @ORM\Column(name="ID_ART", type="integer", length=10, nullable=true)
     */
    private $idArt;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="stockMsisdn")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="DiseAbonnement", inversedBy="stockMsisdn")
     * @ORM\JoinColumn(name="NUM_ABO", referencedColumnName="NUM_ABO")
     */
    private $diseAbonnement;

    /**
     *
     * @var integer $idClient
     * @ORM\Column(name="ID_CLIENT", type="integer", length=11)
     */
    private $idClient;

    /**
     *
     * @var integer $numAbo
     * @ORM\Column(name="NUM_ABO", type="integer", length=8)
     */
    private $numAbo;

    /**
     *
     * @var datetime $dateIas
     * @ORM\Column(name="DATE_IAS", type="datetime", nullable=true)
     */
    private $dateIas;

    /**
     *
     * @var date $dateEngagement
     * @ORM\Column(name="DATE_ENGAGEMENT", type="date", nullable=true)
     */
    private $dateEngagement;

    /**
     *
     * @var integer $etat
     * @ORM\Column(name="ETAT", type="integer")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName="ID_ART")
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="StockNsce", mappedBy="stockmsisdn")
     * @ORM\JoinColumn(name="MSISDN", referencedColumnName="MSISDN", nullable=true)
     */
    private $stocknsce;

    /**
     * @return the $etat
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param number $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     *
     * @return the $stocknsce
     */
    public function getStocknsce()
    {
        return $this->stocknsce;
    }

    /**
     *
     * @param field_type $stocknsce
     */
    public function setStocknsce($stocknsce)
    {
        $this->stocknsce = $stocknsce;
    }

    /**
     *
     * @return the $msisdn
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     *
     * @return the $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     *
     * @return the $dateIas
     */
    public function getDateIas()
    {
        return $this->dateIas;
    }

    /**
     *
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     *
     * @return the $numAbo
     */
    public function getNumAbo()
    {
        return $this->numAbo;
    }

    /**
     *
     * @return the $client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     *
     * @return the $diseAbonnement
     */
    public function getDiseAbonnement()
    {
        return $this->diseAbonnement;
    }

    /**
     *
     * @param number $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    /**
     *
     * @param number $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     *
     * @param number $diseAbonnement
     */
    public function setDiseAbonnement(DiseAbonnement $diseAbonnement)
    {
        $this->diseAbonnement = $diseAbonnement;
    }

    /**
     *
     * @param datetime $dateIas
     */
    public function setDateIas($dateIas)
    {
        $this->dateIas = $dateIas;
    }

    /**
     *
     * @param number $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

    /**
     *
     * @param number $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     *
     * @param number $numAbo
     */
    public function setNumAbo($numAbo)
    {
        $this->numAbo = $numAbo;
    }

    /**
     *
     * @return the $article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     *
     * @param field_type $article
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;
    }

    /**
     *
     * @return the $dateEngagement
     */
    public function getDateEngagement()
    {
        return $this->dateEngagement;
    }

    /**
     *
     * @param date $dateEngagement
     */
    public function setDateEngagement($dateEngagement)
    {
        $this->dateEngagement = $dateEngagement;
    }

    public function getForfaitOptions()
    {
        if ($this->getArticle()) {
            return $this->getArticle()->getForfaitOptions();
        } else {
            return null;
        }
    }

    /**
     * @return Engagement
     */
    public function getEngagement()
    {
        if (!$this->getClient()) {
            return;
        }

        return $this->getClient()->getEngagements()->first();
    }
}
