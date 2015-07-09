<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="STOCK_IMEI")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\StockImeiRepository")
 */
class StockImei
{

    /**
     * Recupere le champ en string
     * Illogique de traiter un msisdn en entier
     *
     * @ORM\Column(name="IMEI", type="string", nullable=false)
     * @ORM\Id
     */
    private $imei;

    /**
     *
     * @var integer $idArt
     * @ORM\Column(name="ID_ART", type="integer", length=10, nullable=true)
     */
    private $idArt;

    /**
     * @var integer $idCmd
     * @ORM\Column(name="ID_CMD", type="integer", length=10, nullable=true)
     */
    private $idCmd;

    /**
     * @var Article
     * @ORM\OneToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName="ID_ART")
     */
    private $article;

    /**
     * @var Commandes
     * @ORM\OneToOne(targetEntity="Commandes")
     * @ORM\JoinColumn(name="ID_CMD", referencedColumnName="ID_CMD")
     */
    private $commande;

    /**
     *
     * @var integer $desimlockPaye
     * @ORM\Column(name="DESIMLOCKPAYE", type="integer", length=10, nullable=true)
     */
    private $desimlockPaye;

    /**
     * @var integer
     * @ORM\Column(name="ID_ES", type="integer", length=4, nullable=false)
     */
    private $idEs;

    /**
     * @var \DateTime
     * @ORM\Column(name="DATE_CREATION", type="datetime", nullable=false)
     */
    private $dateCreation;

    /**
     * @var \DateTime
     * @ORM\Column(name="DATE_DERN_MAJ", type="datetime", nullable=false)
     */
    private $dateDernMaj;

    /**
	 * @return string $imei
	 */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * @param string $imei
     */
    public function setImei($imei)
    {
        $this->imei = $imei;
    }

    /**
	 * @return the $idArt
	 */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
	 * @return the $idCmd
	 */
    public function getIdCmd()
    {
        return $this->idCmd;
    }

    /**
     * @return the $desimlockPaye
     */
    public function getDesimlockPaye()
    {
        return $this->desimlockPaye;
    }

    /**
	 * @param number $idArt
	 */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

    /**
	 * @param number $idCmd
	 */
    public function setIdCmd($idCmd)
    {
        $this->idCmd = $idCmd;
    }

    /**
     * @param number $desimlockPaye
     */
    public function setDesimlockPaye($desimlockPaye)
    {
        $this->desimlockPaye = $desimlockPaye;
    }

    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param Article $article
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;
    }

    /**
     * @return Commandes
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * @param Commandes $commande
     */
    public function setCommande(Commandes $commande)
    {
        $this->commande = $commande;
    }


    /**
     * @return integer
     */
    public function getIdEs()
    {
        return $this->idEs;
    }

    /**
     * @param integer
     * @return StockImei
     */
    public function setIdEs($idEs)
    {
        $this->idEs = $idEs;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime
     * @return StockImei
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateDernMaj()
    {
        return $this->dateDernMaj;
    }

    /**
     * @param \DateTime
     * @return StockImei
     */
    public function setDateDernMaj($dateDernMaj)
    {
        $this->dateDernMaj = $dateDernMaj;
        return $this;
    }

}
