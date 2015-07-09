<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ARTICLE_COMBINAISON")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ArticleCombinaisonRepository")
 */
class ArticleCombinaison
{

    /**
     *
     * @var integer $idAc
     *      @ORM\Column(name="ID_AC", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAc;

    // Les relations avec l'entité Article ont été enlevées pour permettre des requètes plus simple

    /**
     * @ORM\Column(name="ID_ART_PERE", type="integer")
     */
    private $idArtPere;

    /**
     * @ORM\Column(name="ID_ART_FILS", type="integer")
     */
    private $idArtFils;

    /**
     * @ORM\Column(name="IS_TRAITE", type="smallint")
     */
    private $isTraite;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="artCombiPere")
     * @ORM\JoinColumn(name="ID_ART_PERE", referencedColumnName = "ID_ART")
     */
    private $articlePere;

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="artCombiFils")
     * @ORM\JoinColumn(name="ID_ART_FILS", referencedColumnName = "ID_ART")
     */
    private $articleFils;

	/**
     * @return the $idAc
     */
    public function getIdAc()
    {
        return $this->idAc;
    }

	/**
     * @return the $idArtPere
     */
    public function getIdArtPere()
    {
        return $this->idArtPere;
    }

	/**
     * @return the $idArtFils
     */
    public function getIdArtFils()
    {
        return $this->idArtFils;
    }

	/**
     * @return the $isTraite
     */
    public function getIsTraite()
    {
        return $this->isTraite;
    }

	/**
     * @return the $articlePere
     */
    public function getArticlePere()
    {
        return $this->articlePere;
    }

	/**
     * @return the $articleFils
     */
    public function getArticleFils()
    {
        return $this->articleFils;
    }

	/**
     * @param number $idAc
     */
    public function setIdAc($idAc)
    {
        $this->idAc = $idAc;
    }

	/**
     * @param field_type $idArtPere
     */
    public function setIdArtPere($idArtPere)
    {
        $this->idArtPere = $idArtPere;
    }

	/**
     * @param field_type $idArtFils
     */
    public function setIdArtFils($idArtFils)
    {
        $this->idArtFils = $idArtFils;
    }

	/**
     * @param field_type $isTraite
     */
    public function setIsTraite($isTraite)
    {
        $this->isTraite = $isTraite;
    }

	/**
     * @param field_type $articlePere
     */
    public function setArticlePere($articlePere)
    {
        $this->articlePere = $articlePere;
    }

	/**
     * @param field_type $articleFils
     */
    public function setArticleFils($articleFils)
    {
        $this->articleFils = $articleFils;
    }

}
