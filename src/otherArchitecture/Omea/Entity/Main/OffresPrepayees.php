<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="OFFRES_PREPAYEES")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\OffresPrepayeesRepository")
 */
class OffresPrepayees
{
    /**
     * @var integer
     * @ORM\Column(name="ID_OC", type="integer", precision=6)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idOffre;
    /**
     * @ORM\Column(name="ID_ENT", type="integer", precision=5, nullable=false)
     */
    private $idEntite;
    /**
     * @ORM\Column(name="ID_ART", type="integer", precision=10, nullable=true)
     */
    private $idArticle;
    /**
     * @ORM\Column(name="cout", type="decimal", precision=5, scale=2,nullable=false)
     */
    private $cout;
    /**
     * @ORM\Column(name="PRIX_SMS_FFT", type="decimal", precision=7, scale=6,nullable=false)
     */
    private $prixSmsFFT;
    /**
     * @ORM\Column(name="temps", type="integer", precision=11,nullable=false)
     */
    private $temps;
    /**
     * @ORM\Column(name="libelle_temps", type="string", length=50,nullable=true)
     */
    private $libelleTemps;
    /**
     * @ORM\Column(name="prixmin", type="decimal", precision=3, scale=2, nullable=true)
     */
    private $prixMin;
    /**
     * @ORM\Column(name="distributeurs", type="integer", precision=1, nullable=false)
     */
    private $distributeurs;
    /**
     * @ORM\Column(name="optmonde", type="integer", precision=4, nullable=false)
     */
    private $optMonde;
    /**
     * @ORM\Column(name="optgrps", type="integer", precision=4, nullable=false)
     */
    private $optGrps;
    /**
     * @ORM\Column(name="flag_bloque", type="integer", precision=4,nullable=false)
     */
    private $flagBloque;
    /**
     * @ORM\Column(name="ENGAGEMENT", type="string", columnDefinition="ENUM('0', '12', '24)", nullable=false)
     */
    private $engagement;
    /**
     * @ORM\Column(name="classe", type="string", length=30, nullable=true)
     */
    private $classe;
    /**
     * @ORM\Column(name="fluidite", type="integer", precision=4, nullable=false)
     */
    private $fluidite;
    /**
     * @ORM\Column(name="easy", type="integer", precision=4,nullable=false)
     */
    private $easy;
    /**
     * @ORM\Column(name="EXCESS", type="integer", precision=4,nullable=false)
     */
    private $excess;
    /**
     * @ORM\Column(name="SCORE", type="integer", precision=6,nullable=false)
     */
    private $score;
    /**
     * @ORM\Column(name="DEFAULT_CYCLE", type="string", columnDefinition="ENUM('5', '6')", nullable=true)
     */
    private $defautCycle;
    /**
     * @ORM\Column(name="ID_SIM_VERSION", type="integer", precision=10, nullable=true)
     */
    private $idSimVersion;
    /**
     * @ORM\Column(name="ID_NIV_SUB", type="integer", precision=10, nullable=true)
     */
    private $idNivSub;
    /**
     * @ORM\Column(name="ID_SIM_FORMAT_DEFAUT", type="integer",precision=10, nullable=true)
     */
    private $idSimFormatDefaut;
    /**
     * @ORM\Column(name="REF_SAP", type="string", length=18, nullable=false)
     */
    private $refSAP;
    /**
     * @ORM\Column(name="ID_SIM_TARIF", type="integer", precision=8, nullable=false)
     */
    private $idSimTarif;
    /**
     * @ORM\Column(name="ID_HIER_OFFRE", type="integer", precision=11, nullable=true)
     */
    private $idHierOffre;

    /**
     * @param mixed $classe
     */
    public function setClasse( $classe )
    {
        $this->classe = $classe;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $cout
     */
    public function setCout( $cout )
    {
        $this->cout = $cout;
    }

    /**
     * @return mixed
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * @param mixed $defautCycle
     */
    public function setDefautCycle( $defautCycle )
    {
        $this->defautCycle = $defautCycle;
    }

    /**
     * @return mixed
     */
    public function getDefautCycle()
    {
        return $this->defautCycle;
    }

    /**
     * @param mixed $distributeurs
     */
    public function setDistributeurs( $distributeurs )
    {
        $this->distributeurs = $distributeurs;
    }

    /**
     * @return mixed
     */
    public function getDistributeurs()
    {
        return $this->distributeurs;
    }

    /**
     * @param mixed $easy
     */
    public function setEasy( $easy )
    {
        $this->easy = $easy;
    }

    /**
     * @return mixed
     */
    public function getEasy()
    {
        return $this->easy;
    }

    /**
     * @param mixed $engagement
     */
    public function setEngagement( $engagement )
    {
        $this->engagement = $engagement;
    }

    /**
     * @return mixed
     */
    public function getEngagement()
    {
        return $this->engagement;
    }

    /**
     * @param mixed $excess
     */
    public function setExcess( $excess )
    {
        $this->excess = $excess;
    }

    /**
     * @return mixed
     */
    public function getExcess()
    {
        return $this->excess;
    }

    /**
     * @param mixed $flagBloque
     */
    public function setFlagBloque( $flagBloque )
    {
        $this->flagBloque = $flagBloque;
    }

    /**
     * @return mixed
     */
    public function getFlagBloque()
    {
        return $this->flagBloque;
    }

    /**
     * @param mixed $fluidite
     */
    public function setFluidite( $fluidite )
    {
        $this->fluidite = $fluidite;
    }

    /**
     * @return mixed
     */
    public function getFluidite()
    {
        return $this->fluidite;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle( $idArticle )
    {
        $this->idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param mixed $idEntite
     */
    public function setIdEntite( $idEntite )
    {
        $this->idEntite = $idEntite;
    }

    /**
     * @return mixed
     */
    public function getIdEntite()
    {
        return $this->idEntite;
    }

    /**
     * @param mixed $idHierOffre
     */
    public function setIdHierOffre( $idHierOffre )
    {
        $this->idHierOffre = $idHierOffre;
    }

    /**
     * @return mixed
     */
    public function getIdHierOffre()
    {
        return $this->idHierOffre;
    }

    /**
     * @param mixed $idNivSub
     */
    public function setIdNivSub( $idNivSub )
    {
        $this->idNivSub = $idNivSub;
    }

    /**
     * @return mixed
     */
    public function getIdNivSub()
    {
        return $this->idNivSub;
    }

    /**
     * @param int $idOffre
     */
    public function setIdOffre( $idOffre )
    {
        $this->idOffre = $idOffre;
    }

    /**
     * @return int
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * @param mixed $idSimFormatDefaut
     */
    public function setIdSimFormatDefaut( $idSimFormatDefaut )
    {
        $this->idSimFormatDefaut = $idSimFormatDefaut;
    }

    /**
     * @return mixed
     */
    public function getIdSimFormatDefaut()
    {
        return $this->idSimFormatDefaut;
    }

    /**
     * @param mixed $idSimTarif
     */
    public function setIdSimTarif( $idSimTarif )
    {
        $this->idSimTarif = $idSimTarif;
    }

    /**
     * @return mixed
     */
    public function getIdSimTarif()
    {
        return $this->idSimTarif;
    }

    /**
     * @param mixed $idSimVersion
     */
    public function setIdSimVersion( $idSimVersion )
    {
        $this->idSimVersion = $idSimVersion;
    }

    /**
     * @return mixed
     */
    public function getIdSimVersion()
    {
        return $this->idSimVersion;
    }

    /**
     * @param mixed $libelleTemps
     */
    public function setLibelleTemps( $libelleTemps )
    {
        $this->libelleTemps = $libelleTemps;
    }

    /**
     * @return mixed
     */
    public function getLibelleTemps()
    {
        return $this->libelleTemps;
    }

    /**
     * @param mixed $optGrps
     */
    public function setOptGrps( $optGrps )
    {
        $this->optGrps = $optGrps;
    }

    /**
     * @return mixed
     */
    public function getOptGrps()
    {
        return $this->optGrps;
    }

    /**
     * @param mixed $optMonde
     */
    public function setOptMonde( $optMonde )
    {
        $this->optMonde = $optMonde;
    }

    /**
     * @return mixed
     */
    public function getOptMonde()
    {
        return $this->optMonde;
    }

    /**
     * @param mixed $prixMin
     */
    public function setPrixMin( $prixMin )
    {
        $this->prixMin = $prixMin;
    }

    /**
     * @return mixed
     */
    public function getPrixMin()
    {
        return $this->prixMin;
    }

    /**
     * @param mixed $prixSmsFFT
     */
    public function setPrixSmsFFT( $prixSmsFFT )
    {
        $this->prixSmsFFT = $prixSmsFFT;
    }

    /**
     * @return mixed
     */
    public function getPrixSmsFFT()
    {
        return $this->prixSmsFFT;
    }

    /**
     * @param mixed $refSAP
     */
    public function setRefSAP( $refSAP )
    {
        $this->refSAP = $refSAP;
    }

    /**
     * @return mixed
     */
    public function getRefSAP()
    {
        return $this->refSAP;
    }

    /**
     * @param mixed $score
     */
    public function setScore( $score )
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $temps
     */
    public function setTemps( $temps )
    {
        $this->temps = $temps;
    }

    /**
     * @return mixed
     */
    public function getTemps()
    {
        return $this->temps;
    }


}
