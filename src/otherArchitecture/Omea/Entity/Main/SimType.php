<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="SIM_TYPE")
 * @ORM\Entity
 */
class SimType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SIM_TYPE", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idSimType;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=45, nullable=true)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="USAGE", type="string", length=45, nullable=true)
     */
    private $usage;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESEAU", type="integer")
     */
    private $reseau = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="OFFRE_ID", type="integer", nullable=true)
     */
    private $offreId;

    /**
     * @var SimFormat
     *
     * @ORM\ManyToOne(targetEntity="SimFormat")
     * @ORM\JoinColumn(name="ID_SIM_FORMAT", referencedColumnName="ID_SIM_FORMAT", nullable=true)
     */
    private $simFormat;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SIM_VERSION", type="integer", nullable=true)
     */
    private $idSimVersion;

    /**
     * Indique le type de la sim, NULL Pour les postpaid, 2 pour les prépaid
     *
     * @var integer
     *
     * @ORM\Column(name="ID_TE", type="integer", nullable=true)
     */
    private $idTe;

    /**
     * Indique quelle sim du référentiel il faut utiliser
     *
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="simTypes")
     * @ORM\JoinColumn(name="ID_ART", referencedColumnName = "ID_ART")
     */
    private $article;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ART_SIM_NUE", type="integer", nullable=true)
     */
    private $idArtSimNue;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="SimFormat", inversedBy="simTypes")
     * @ORM\JoinTable(name="SIM_TYPE_FORMAT",
     *     joinColumns={@ORM\JoinColumn(name="ID_SIM_TYPE", referencedColumnName="ID_SIM_TYPE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="ID_SIM_FORMAT", referencedColumnName="ID_SIM_FORMAT")}
     * )
     */
    private $simFormats;

    public function __construct()
    {
        $this->simFormats = new ArrayCollection();
    }

    /**
     * Gets the value of idSimType.
     *
     * @return integer
     */
    public function getIdSimType()
    {
        return $this->idSimType;
    }

    /**
     * Sets the value of idSimType.
     *
     * @param integer $idSimType the id sim type
     *
     * @return self
     */
    public function setIdSimType($idSimType)
    {
        $this->idSimType = $idSimType;

        return $this;
    }

    /**
     * Gets the value of libelle.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Sets the value of libelle.
     *
     * @param string $libelle the libelle
     *
     * @return self
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Gets the value of usage.
     *
     * @return string
     */
    public function getUsage()
    {
        return $this->usage;
    }

    /**
     * Sets the value of usage.
     *
     * @param string $usage the usage
     *
     * @return self
     */
    public function setUsage($usage)
    {
        $this->usage = $usage;

        return $this;
    }

    /**
     * Gets the value of reseau.
     *
     * @return integer
     */
    public function getReseau()
    {
        return $this->reseau;
    }

    /**
     * Sets the value of reseau.
     *
     * @param integer $reseau the reseau
     *
     * @return self
     */
    public function setReseau($reseau)
    {
        $this->reseau = $reseau;

        return $this;
    }

    /**
     * Gets the value of offreId.
     *
     * @return integer
     */
    public function getOffreId()
    {
        return $this->offreId;
    }

    /**
     * Sets the value of offreId.
     *
     * @param integer $offreId the offre id
     *
     * @return self
     */
    public function setOffreId($offreId)
    {
        $this->offreId = $offreId;

        return $this;
    }

    /**
     * Gets the value of simFormat.
     *
     * @return SimFormat
     */
    public function getSimFormat()
    {
        return $this->simFormat;
    }

    /**
     * Sets the value of simFormat.
     *
     * @param SimFormat $simFormat the sim format
     *
     * @return self
     */
    public function setSimFormat(SimFormat $simFormat = null)
    {
        $this->simFormat = $simFormat;

        return $this;
    }

    /**
     * Gets the value of idSimVersion.
     *
     * @return integer
     */
    public function getIdSimVersion()
    {
        return $this->idSimVersion;
    }

    /**
     * Sets the value of idSimVersion.
     *
     * @param integer $idSimVersion the id sim version
     *
     * @return self
     */
    public function setIdSimVersion($idSimVersion)
    {
        $this->idSimVersion = $idSimVersion;

        return $this;
    }

    /**
     * Gets the Indique le type de la sim, NULL Pour les postpaid, 2 pour les prépaid.
     *
     * @return integer
     */
    public function getIdTe()
    {
        return $this->idTe;
    }

    /**
     * Sets the Indique le type de la sim, NULL Pour les postpaid, 2 pour les prépaid.
     *
     * @param integer $idTe the id te
     *
     * @return self
     */
    public function setIdTe($idTe)
    {
        $this->idTe = $idTe;

        return $this;
    }

    /**
     * Gets the Indique quelle sim du référentiel il faut utiliser.
     *
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Sets the Indique quelle sim du référentiel il faut utiliser.
     *
     * @param Article $article
     *
     * @return self
     */
    public function setArticle(Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Gets the value of idArtSimNue.
     *
     * @return integer
     */
    public function getIdArtSimNue()
    {
        return $this->idArtSimNue;
    }

    /**
     * Sets the value of idArtSimNue.
     *
     * @param integer $idArtSimNue the id art sim nue
     *
     * @return self
     */
    public function setIdArtSimNue($idArtSimNue)
    {
        $this->idArtSimNue = $idArtSimNue;

        return $this;
    }

    /**
     * Gets the SimFormats
     *
     * @return ArrayCollection
     */
    public function getSimFormats()
    {
        return $this->simFormats;
    }
}
