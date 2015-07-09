<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Omea\Entity\Entity\Article
 *
 * @ORM\Table(name="ARTICLE")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ArticleRepository")
 */
class Article
{
    /**
     *
     * @var integer $idArticle
     * @ORM\Column(name="ID_ART", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idArticle;

    /**
     *
     * @var TypeEntite $typeEntite
     * @ORM\ManyToOne(targetEntity="TypeEntite", cascade={"persist"})
     * @ORM\JoinColumn(name="ID_TE", referencedColumnName = "ID_TE")
     */
    private $typeEntite;

    /**
     * @ORM\OneToMany(targetEntity="ReferentielMaterielsForfait", mappedBy="articleForfait")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName = "ID_ART_FORFAIT")
     */
    private $referentielMaterielsForfait;
    
    /**
     * @ORM\OneToMany(targetEntity="LigneAdsl", mappedBy="article")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName = "ID_ART")
     */
    private $ligneAdsl;

    /**
     *
     * @var integer $idFw
     * @ORM\Column(name="ID_FW", type="integer")
     */
    private $idFw;

    /**
     * @var string $typeArticle
     * @ORM\Column(name="TYPE_ARTICLE", type="string", length=20)
     */
    private $typeArticle;

    /**
     * @ORM\Column(name="EN_VENTE", type="integer")
     */
    private $enVente;

    /**
     *
     * @var string $codeWeb
     * @ORM\Column(name="CODE_WEB", type="string", length=20)
     */
    private $codeWeb;

    /**
     * @ORM\Column(name="REF_SAP", type="string", length=20)
     */
    private $refSap;

    /**
     * @ORM\OneToMany(targetEntity="Forfait", mappedBy="article")
     */
    private $forfait;

    /**
     * @ORM\Column(name="TITRE_ADV", type="string", length=255)
     */
    private $titreAdv;

    /**
     * @ORM\Column(name="SSTITRE_ADV", type="string", length=255)
     */
    private $sstitreAdv;

    /**
     * @ORM\Column(name="TITRE_MARKET", type="string", length=255)
     */
    private $titreMarket;

    /**
     * @ORM\Column(name="SSTITRE_MARKET", type="string", length=255)
     */
    private $sstitreMarket;

    /**
     * @ORM\Column(name="MONTANT", type="decimal")
     */
    private $montant;

    /**
     * @ORM\OneToMany(targetEntity="FidelisationProduits", mappedBy="article")
     */
    private $fidelisationProduit;

    /**
     * @ORM\OneToMany(targetEntity="ArticleCombinaison", mappedBy="articlePere")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName="ID_ART_PERE")
     */
    private $artCombiPere;

    /**
     * @ORM\OneToMany(targetEntity="ArticleCombinaison", mappedBy="articleFils")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName="ID_ART_FILS")
     */
    private $artCombiFils;

    /**
     * @ORM\OneToMany(targetEntity="SimType", mappedBy="article")
     */
    private $simTypes;

    public function __construct()
    {
        $this->simTypes  = new ArrayCollection();
    }

    /**
     * @return the $montant
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param field_type $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return the $idArticle
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @return TypeEntite $typeEntite
     */
    public function getTypeEntite()
    {
        return $this->typeEntite;
    }

    /**
     * @return the $idFw
     */
    public function getIdFw()
    {
        return $this->idFw;
    }

    /**
     * @return  the $typeArticle
     */
    public function getTypeArticle()
    {
        return $this->typeArticle;
    }

    /**
     * @return the $enVente
     */
    public function getEnVente()
    {
        return $this->enVente;
    }

    /**
     * @return the $codeWeb
     */
    public function getCodeWeb()
    {
        return $this->codeWeb;
    }

    /**
     * @return the $refSap
     */
    public function getRefSap()
    {
        return $this->refSap;
    }

    /**
     * @return Forfait $forfait
     */
    public function getForfait()
    {
        return $this->forfait;
    }

    /**
     * @return the $artCombiPere
     */
    public function getArtCombiPere()
    {
        return $this->artCombiPere;
    }

    /**
     * @return the $artCombiFils
     */
    public function getArtCombiFils()
    {
        return $this->artCombiFils;
    }

    /**
     * @return the $titreAdv
     */
    public function getTitreAdv()
    {
        return $this->titreAdv;
    }

    /**
     * @return the $sstitreAdv
     */
    public function getSstitreAdv()
    {
        return $this->sstitreAdv;
    }

    /**
     * @return string $titreMarket
     */
    public function getTitreMarket()
    {
        return $this->titreMarket;
    }

    /**
     * @return the $sstitreMarket
     */
    public function getSstitreMarket()
    {
        return $this->sstitreMarket;
    }

    /**
     * @param number $idArticle
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;
    }

    /**
     * @param TypeEntite $typeEntite
     */
    public function setTypeEntite($typeEntite)
    {
        $this->typeEntite = $typeEntite;
    }

    /**
     * @param number $idFw
     */
    public function setIdFw($idFw)
    {
        $this->idFw = $idFw;
    }

    /**
     * @param  string $typeArticle
     */
    public function setTypeArticle($typeArticle)
    {
        $this->typeArticle = $typeArticle;
    }

    /**
     * @param field_type $enVente
     */
    public function setEnVente($enVente)
    {
        $this->enVente = $enVente;
    }

    /**
     * @param string $codeWeb
     */
    public function setCodeWeb($codeWeb)
    {
        $this->codeWeb = $codeWeb;
    }

    /**
     * @param field_type $refSap
     */
    public function setRefSap($refSap)
    {
        $this->refSap = $refSap;
    }

    /**
     * @param field_type $forfait
     */
    public function setForfait($forfait)
    {
        $this->forfait = $forfait;
    }

    /**
     * @param field_type $artCombiPere
     */
    public function setArtCombiPere($artCombiPere)
    {
        $this->artCombiPere = $artCombiPere;
    }

    /**
     * @param field_type $artCombiFils
     */
    public function setArtCombiFils($artCombiFils)
    {
        $this->artCombiFils = $artCombiFils;
    }

    /**
     * @param field_type $titreAdv
     */
    public function setTitreAdv($titreAdv)
    {
        $this->titreAdv = $titreAdv;
    }

    /**
     * @param field_type $sstitreAdv
     */
    public function setSstitreAdv($sstitreAdv)
    {
        $this->sstitreAdv = $sstitreAdv;
    }

    /**
     * @param field_type $titreMarket
     */
    public function setTitreMarket($titreMarket)
    {
        $this->titreMarket = $titreMarket;
    }

    /**
     * @param field_type $sstitreMarket
     */
    public function setSstitreMarket($sstitreMarket)
    {
        $this->sstitreMarket = $sstitreMarket;
    }

    /**
     * @param FidelisationProduits $fidelisationProduit
     */
    public function setFidelisationProduit($fidelisationProduit)
    {
        $this->fidelisationProduit = $fidelisationProduit;
    }

    /**
     * @return FidelisationProduits
     */
    public function getFidelisationProduit()
    {
        return $this->fidelisationProduit;
    }

    /**
     * Gets the value of simTypes.
     *
     * @return ArrayCollection
     */
    public function getSimTypes()
    {
        return $this->simTypes;
    }

    /**
     * Returns true if the article is composed of multiple articles.
     * @return boolean
     */
    public function isComposite()
    {
        return strpos($this->typeEntite->getLibelle(), '+') !== false;
    }
}