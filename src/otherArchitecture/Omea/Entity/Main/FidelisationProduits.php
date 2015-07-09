<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FIDELISATION_PRODUITS")
 * @ORM\Entity
 */
class FidelisationProduits
{

    /**
     *
     * @var integer $idfp
     *
     * @ORM\Column(name="IDFP", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfp;

    /**
     *
     * @var integer $idProduit
     * @ORM\Column(name="ID_PRODUIT", type="integer", nullable=false)
     */
    private $idProduit;

    /**
     *
     * @var integer $idArt
     * @ORM\Column(name="ID_ART", type="integer", nullable=false)
     */
    private $idArt;


    /**
     * @ORM\OneToOne(targetEntity="Article")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName="ID_ART")
     */
    private $article;

    /**
     *
     * @var integer $montantAchatHt
     * @ORM\Column(name="MONTANTACHATHT", type="decimal", nullable=false)
     */
    private $montantAchatHt;

    /**
     *
     * @var integer $montantNuTTC
     * @ORM\Column(name="MONTANTNUTTC", type="decimal", nullable=false)
     */
    private $montantNuTTC;

    /**
     * @var date $dateDebMea
     * @ORM\Column(name="DATEDEBMEA", type="date")
     */
    private $dateDebMea;

    /**
     * @var date $dateFinMea
     * @ORM\Column(name="DATEFINMEA", type="date")
     */
    private $dateFinMea;

    /**
     *
     * @var integer $reserveWeb
     * @ORM\Column(name="RESERVEWEB", type="integer")
     */
    private $reserveWeb;

    /**
     * @var datetime $derniereModifMontantAchatHt
     * @ORM\Column(name="DERNIERE_MODIF_MONTANT_ACHAT_HT", type="datetime")
     */
    private $derniereModifMontantAchatHt;


    /**
     *
     * @var string $fidelisableXXX
     * @ORM\Column(name="FIDELISABLE_XXX", type="string", length=4, nullable=false)
     */
    private $fidelisableXXX;

    /**
     * @param \Omea\Entity\Main\date $dateDebMea
     */
    public function setDateDebMea($dateDebMea)
    {
        $this->dateDebMea = $dateDebMea;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateDebMea()
    {
        return $this->dateDebMea;
    }

    /**
     * @param \Omea\Entity\Main\date $dateFinMea
     */
    public function setDateFinMea($dateFinMea)
    {
        $this->dateFinMea = $dateFinMea;
    }

    /**
     * @return \Omea\Entity\Main\date
     */
    public function getDateFinMea()
    {
        return $this->dateFinMea;
    }

    /**
     * @param \Omea\Entity\Main\datetime $derniereModifMontantAchatHt
     */
    public function setDerniereModifMontantAchatHt($derniereModifMontantAchatHt)
    {
        $this->derniereModifMontantAchatHt = $derniereModifMontantAchatHt;
    }

    /**
     * @return \Omea\Entity\Main\datetime
     */
    public function getDerniereModifMontantAchatHt()
    {
        return $this->derniereModifMontantAchatHt;
    }

    /**
     * @param string $fidelisableXXX
     */
    public function setFidelisableXXX($fidelisableXXX)
    {
        $this->fidelisableXXX = $fidelisableXXX;
    }

    /**
     * @return string
     */
    public function getFidelisableXXX()
    {
        return $this->fidelisableXXX;
    }

    /**
     * @param int $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

    /**
     * @return int
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

    /**
     * @param int $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return int
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param int $idfp
     */
    public function setIdfp($idfp)
    {
        $this->idfp = $idfp;
    }

    /**
     * @return int
     */
    public function getIdfp()
    {
        return $this->idfp;
    }

    /**
     * @param int $montantAchatHt
     */
    public function setMontantAchatHt($montantAchatHt)
    {
        $this->montantAchatHt = $montantAchatHt;
    }

    /**
     * @return int
     */
    public function getMontantAchatHt()
    {
        return $this->montantAchatHt;
    }

    /**
     * @param int $montantNuTTC
     */
    public function setMontantNuTTC($montantNuTTC)
    {
        $this->montantNuTTC = $montantNuTTC;
    }

    /**
     * @return int
     */
    public function getMontantNuTTC()
    {
        return $this->montantNuTTC;
    }

    /**
     * @param int $reserveWeb
     */
    public function setReserveWeb($reserveWeb)
    {
        $this->reserveWeb = $reserveWeb;
    }

    /**
     * @return int
     */
    public function getReserveWeb()
    {
        return $this->reserveWeb;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

}
