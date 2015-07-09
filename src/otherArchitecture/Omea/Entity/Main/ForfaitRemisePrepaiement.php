<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForfaitRemisePrepaiement
 *
 * @ORM\Table(name="FORFAIT_REMISE_PREPAIEMENT", indexes={@ORM\Index(name="FK_FORFAIT_OPTION_idx", columns={"ID_ART", "ID_OPTION"})})
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ForfaitRemisePrepaiementRepository")
 */
class ForfaitRemisePrepaiement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_FORFAIT_REMISE_PREPAIEMENT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idForfaitRemisePrepaiement;

    /**
     * @var float
     *
     * @ORM\Column(name="REMISE", type="float", precision=10, scale=2, nullable=false)
     */
    private $remise;

    /**
     * @var integer
     *
     * @ORM\Column(name="MOIS", type="integer", nullable=false)
     */
    private $mois;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_ART", referencedColumnName="ID_ART")
     * })
     */
    private $article;

    /**
     * @var \Option
     *
     * @ORM\ManyToOne(targetEntity="Options")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_OPTION", referencedColumnName="ID_OPTION")
     * })
     */
    private $option;

    /**
     * Get idForfaitRemisePrepaiement
     *
     * @return integer
     */
    public function getIdForfaitRemisePrepaiement()
    {
        return $this->idForfaitRemisePrepaiement;
    }

    /**
     * Set remise
     *
     * @param  float                    $remise
     * @return ForfaitRemisePrepaiement
     */
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get remise
     *
     * @return float
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set mois
     *
     * @param  integer                  $mois
     * @return ForfaitRemisePrepaiement
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return integer
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set idArt
     *
     * @param  Article                  $idArt
     * @return ForfaitRemisePrepaiement
     */
    public function setArticle(Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get idArt
     *
     * @return ForfaitOptions
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param \Option $option
     */
    public function setOption($option)
    {
        $this->option = $option;
    }

    /**
     * @return \Option
     */
    public function getOption()
    {
        return $this->option;
    }

}
