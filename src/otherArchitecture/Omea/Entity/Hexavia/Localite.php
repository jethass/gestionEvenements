<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localite
 *
 * @ORM\Table(name="localite", uniqueConstraints={@ORM\UniqueConstraint(name="code_insee_localite", columns={"code_insee_localite", "code_postal"})}, indexes={@ORM\Index(name="idx_code_postal", columns={"code_postal"})})
 * @ORM\Entity(repositoryClass="Omea\Entity\Hexavia\LocaliteRepository")
 */
class Localite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_insee_localite", type="string", length=5, nullable=false)
     */
    private $codeInseeLocalite = '';

    /**
     * @var string
     *
     * @ORM\Column(name="code_insee_commune_globale", type="string", length=5, nullable=false)
     */
    private $codeInseeCommuneGlobale = '';

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_localite", type="string", length=38, nullable=false)
     */
    private $libelleLocalite = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="ind_pluri", type="smallint", nullable=false)
     */
    private $indPluri = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ind_lieu_dit", type="smallint", nullable=false)
     */
    private $indLieuDit = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ind_comm_roudis", type="smallint", nullable=false)
     */
    private $indCommRoudis = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=false)
     */
    private $codePostal = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="code_insee_commune_roudis", type="string", length=5, nullable=false)
     */
    private $codeInseeCommuneRoudis = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="ind_fiab", type="smallint", nullable=false)
     */
    private $indFiab = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_acheminement", type="string", length=32, nullable=false)
     */
    private $libelleAcheminement = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_cre", type="date", nullable=false)
     */
    private $dateCre = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_maj", type="date", nullable=false)
     */
    private $dateMaj = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="type_maj", type="string", length=1, nullable=false)
     */
    private $typeMaj = '';

    /**
     * @param string $codeInseeCommuneGlobale
     */
    public function setCodeInseeCommuneGlobale($codeInseeCommuneGlobale)
    {
        $this->codeInseeCommuneGlobale = $codeInseeCommuneGlobale;
    }

    /**
     * @return string
     */
    public function getCodeInseeCommuneGlobale()
    {
        return $this->codeInseeCommuneGlobale;
    }

    /**
     * @param string $codeInseeCommuneRoudis
     */
    public function setCodeInseeCommuneRoudis($codeInseeCommuneRoudis)
    {
        $this->codeInseeCommuneRoudis = $codeInseeCommuneRoudis;
    }

    /**
     * @return string
     */
    public function getCodeInseeCommuneRoudis()
    {
        return $this->codeInseeCommuneRoudis;
    }

    /**
     * @param string $codeInseeLocalite
     */
    public function setCodeInseeLocalite($codeInseeLocalite)
    {
        $this->codeInseeLocalite = $codeInseeLocalite;
    }

    /**
     * @return string
     */
    public function getCodeInseeLocalite()
    {
        return $this->codeInseeLocalite;
    }

    /**
     * @param int $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param \DateTime $dateCre
     */
    public function setDateCre($dateCre)
    {
        $this->dateCre = $dateCre;
    }

    /**
     * @return \DateTime
     */
    public function getDateCre()
    {
        return $this->dateCre;
    }

    /**
     * @param \DateTime $dateMaj
     */
    public function setDateMaj($dateMaj)
    {
        $this->dateMaj = $dateMaj;
    }

    /**
     * @return \DateTime
     */
    public function getDateMaj()
    {
        return $this->dateMaj;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $indCommRoudis
     */
    public function setIndCommRoudis($indCommRoudis)
    {
        $this->indCommRoudis = $indCommRoudis;
    }

    /**
     * @return int
     */
    public function getIndCommRoudis()
    {
        return $this->indCommRoudis;
    }

    /**
     * @param int $indFiab
     */
    public function setIndFiab($indFiab)
    {
        $this->indFiab = $indFiab;
    }

    /**
     * @return int
     */
    public function getIndFiab()
    {
        return $this->indFiab;
    }

    /**
     * @param int $indLieuDit
     */
    public function setIndLieuDit($indLieuDit)
    {
        $this->indLieuDit = $indLieuDit;
    }

    /**
     * @return int
     */
    public function getIndLieuDit()
    {
        return $this->indLieuDit;
    }

    /**
     * @param int $indPluri
     */
    public function setIndPluri($indPluri)
    {
        $this->indPluri = $indPluri;
    }

    /**
     * @return int
     */
    public function getIndPluri()
    {
        return $this->indPluri;
    }

    /**
     * @param string $libelleAcheminement
     */
    public function setLibelleAcheminement($libelleAcheminement)
    {
        $this->libelleAcheminement = $libelleAcheminement;
    }

    /**
     * @return string
     */
    public function getLibelleAcheminement()
    {
        return $this->libelleAcheminement;
    }

    /**
     * @param string $libelleLocalite
     */
    public function setLibelleLocalite($libelleLocalite)
    {
        $this->libelleLocalite = $libelleLocalite;
    }

    /**
     * @return string
     */
    public function getLibelleLocalite()
    {
        return $this->libelleLocalite;
    }

    /**
     * @param string $typeMaj
     */
    public function setTypeMaj($typeMaj)
    {
        $this->typeMaj = $typeMaj;
    }

    /**
     * @return string
     */
    public function getTypeMaj()
    {
        return $this->typeMaj;
    }

}
