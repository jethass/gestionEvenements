<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="FORFAIT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ForfaitRepository")
 */
class Forfait
{

    /**
     *
     * @var smallint $offreId
     *      @ORM\Column(name="offre_id", type="smallint")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="NONE")
     */
    private $offreId;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="forfait")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName = "ID_ART")
     */
    private $article;

    /**
     *
     * @var decimal $cout
     *      @ORM\Column(name="cout", type="decimal", precision=5, scale=2)
     */
    private $cout;

    /**
     *
     * @var decimal $distributeurs
     *      @ORM\Column(name="distributeurs", type="integer")
     */
    private $distributeurs;

    /**
     *
     * @var string $engagement
     *      @ORM\Column(name="ENGAGEMENT", type="string", length=4)
     */
    private $engagement;

    /**
     *
     * @var int $idHierOffre
     *      @ORM\Column(name="ID_HIER_OFFRE", type="integer", nullable=true)
     */
    private $idHierOffre;

    /**
     *
     * @var int $IdNivSub
     *      @ORM\Column(name="ID_NIV_SUB", type="integer", nullable=true)
     */
    private $IdNivSub;

    /**
     *
     * @var string $refSap
     *      @ORM\Column(name="REF_SAP", type="string", length=18, nullable=true)
     */
    private $refSap;

    /**
     *
     * @var decimal $avanceSurForfait
     *      @ORM\Column(name="AVANCE_SUR_FORFAIT", type="decimal")
     */
    private $avanceSurForfait;

    /**
     *
     * @var string fairUseData
     *      @ORM\Column(name="fair_use_data", type="string")
     */
    private $fairUseData;

    /**
     *
     * @var integer plafondData
     *      @ORM\Column(name="plafond_data", type="integer")
     */
    private $plafondData;

    /**
     *
     * @var integer flagBloque
     *      @ORM\Column(name="flag_bloque", type="integer")
     */
    private $flagBloque;

    /**
     *
     * @var integer idArt
     *      @ORM\Column(name="ID_ART", type="integer")
     */
    private $idArt;

    /**
     * @ORM\OneToMany(targetEntity="MigrationInternet", mappedBy="forfaitSource")
     * @ORM\JoinColumn(name="REF_SAP", referencedColumnName="OFFRE_SOURCE")
     */
    private $migrationInternetSource;
    
    /**
     * @ORM\OneToMany(targetEntity="MigrationInternet", mappedBy="forfaitCible")
     * @ORM\JoinColumn(name="REF_SAP", referencedColumnName="OFFRE_CIBLE")
     */
    private $migrationInternetCible;

    /**
     * @var string libelleUssd
     * @ORM\Column(name="LIBELLE_USSD", type="string")
     */
    private $libelleUssd;
    
    
     /**
     *
     * @var decimal $coutB2b
     *      @ORM\Column(name="cout_b2b", type="decimal", precision=5, scale=2)
     */
    private $coutB2b;
    
    

    /**
     * @param string $libelleUssd
     */
    public function setLibelleUssd($libelleUssd)
    {
        $this->libelleUssd = $libelleUssd;
    }

    /**
     * @return string
     */
    public function getLibelleUssd()
    {
        return $this->libelleUssd;
    }
    
    /**
     * @return the $migrationInternetSource
     */
    public function getMigrationInternetSource()
    {
        return $this->migrationInternetSource;
    }

	/**
     * @return the $migrationInternetCible
     */
    public function getMigrationInternetCible()
    {
        return $this->migrationInternetCible;
    }

	/**
     * @param field_type $migrationInternetSource
     */
    public function setMigrationInternetSource($migrationInternetSource)
    {
        $this->migrationInternetSource = $migrationInternetSource;
    }

	/**
     * @param field_type $migrationInternetCible
     */
    public function setMigrationInternetCible($migrationInternetCible)
    {
        $this->migrationInternetCible = $migrationInternetCible;
    }

	/**
     * @return the $offreId
     */
    public function getOffreId()
    {
        return $this->offreId;
    }

    /**
     * @return Article $article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return the $cout
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * @return the $distributeurs
     */
    public function getDistributeurs()
    {
        return $this->distributeurs;
    }

    /**
     * @return the $engagement
     */
    public function getEngagement()
    {
        return $this->engagement;
    }

    /**
     * @return the $idHierOffre
     */
    public function getIdHierOffre()
    {
        return $this->idHierOffre;
    }

    /**
     * @return the $IdNivSub
     */
    public function getIdNivSub()
    {
        return $this->IdNivSub;
    }

    /**
     * @return the $refSap
     */
    public function getRefSap()
    {
        return $this->refSap;
    }

    /**
     * @return the $avanceSurForfait
     */
    public function getAvanceSurForfait()
    {
        return $this->avanceSurForfait;
    }

    /**
     * @return the $fairUseData
     */
    public function getFairUseData()
    {
        return $this->fairUseData;
    }

    /**
     * @return the $plafondData
     */
    public function getPlafondData()
    {
        return $this->plafondData;
    }

    /**
     * @return the $flagBloque
     */
    public function getFlagBloque()
    {
        return $this->flagBloque;
    }

    /**
     * @return the $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }
    
    /**
     * @return the $coutB2b
     */
    public function getCoutB2b()
    {
        return $this->coutB2b;
    }

    /**
     * @param  $offreId
     */
    public function setOffreId($offreId)
    {
        $this->offreId = $offreId;
    }

    /**
     * @param Article $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * @param float $cout
     */
    public function setCout($cout)
    {
        $this->cout = $cout;
    }

    /**
     * @param Distributeurs $distributeurs
     */
    public function setDistributeurs($distributeurs)
    {
        $this->distributeurs = $distributeurs;
    }

    /**
     * @param string $engagement
     */
    public function setEngagement($engagement)
    {
        $this->engagement = $engagement;
    }

    /**
     * @param number $idHierOffre
     */
    public function setIdHierOffre($idHierOffre)
    {
        $this->idHierOffre = $idHierOffre;
    }

    /**
     * @param number $IdNivSub
     */
    public function setIdNivSub($IdNivSub)
    {
        $this->IdNivSub = $IdNivSub;
    }

    /**
     * @param string $refSap
     */
    public function setRefSap($refSap)
    {
        $this->refSap = $refSap;
    }

    /**
     * @param float $avanceSurForfait
     */
    public function setAvanceSurForfait($avanceSurForfait)
    {
        $this->avanceSurForfait = $avanceSurForfait;
    }

    /**
     * @param string $fairUseData
     */
    public function setFairUseData($fairUseData)
    {
        $this->fairUseData = $fairUseData;
    }

    /**
     * @param number $plafondData
     */
    public function setPlafondData($plafondData)
    {
        $this->plafondData = $plafondData;
    }

    /**
     * @param number $flagBloque
     */
    public function setFlagBloque($flagBloque)
    {
        $this->flagBloque = $flagBloque;
    }

    /**
     * @param number $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }
    
    /**
     * @param float $cout
     */
    public function setCoutB2b($coutB2b)
    {
        $this->coutB2b = $coutB2b;
    }

}
