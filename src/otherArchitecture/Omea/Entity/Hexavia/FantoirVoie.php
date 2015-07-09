<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FantoirVoie
 *
 * @ORM\Table(name="FANTOIR_VOIE", indexes={@ORM\Index(name="CODE_RIVOLI", columns={"CODE_RIVOLI", "CODE_CLEF", "NOM_VOIE", "NOM_VOIE_COMPLET", "TYPE_VOIE"}), @ORM\Index(name="CODE_INSEE", columns={"CODE_INSEE"}), @ORM\Index(name="CODE_INSEE_TYPE_VOIE", columns={"CODE_INSEE", "TYPE_VOIE"})})
 * @ORM\Entity
 */
class FantoirVoie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE_LOCALITE", type="string", length=38, nullable=true)
     */
    private $libelleLocalite;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_RIVOLI", type="string", length=4, nullable=true)
     */
    private $codeRivoli;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_CLEF", type="string", length=1, nullable=true)
     */
    private $codeClef;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VOIE", type="string", length=26, nullable=true)
     */
    private $nomVoie;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VOIE_COMPLET", type="string", length=30, nullable=true)
     */
    private $nomVoieComplet;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE_VOIE", type="string", length=4, nullable=true)
     */
    private $typeVoie;

    /**
     * @var integer
     *
     * @ORM\Column(name="CODE_POSTAL", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="CODE_INSEE", type="string", length=5, nullable=true)
     */
    private $codeInsee;

    /**
     * @param string $codeClef
     */
    public function setCodeClef($codeClef)
    {
        $this->codeClef = $codeClef;
    }

    /**
     * @return string
     */
    public function getCodeClef()
    {
        return $this->codeClef;
    }

    /**
     * @param string $codeInsee
     */
    public function setCodeInsee($codeInsee)
    {
        $this->codeInsee = $codeInsee;
    }

    /**
     * @return string
     */
    public function getCodeInsee()
    {
        return $this->codeInsee;
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
     * @param string $codeRivoli
     */
    public function setCodeRivoli($codeRivoli)
    {
        $this->codeRivoli = $codeRivoli;
    }

    /**
     * @return string
     */
    public function getCodeRivoli()
    {
        return $this->codeRivoli;
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
     * @param string $nomVoie
     */
    public function setNomVoie($nomVoie)
    {
        $this->nomVoie = $nomVoie;
    }

    /**
     * @return string
     */
    public function getNomVoie()
    {
        return $this->nomVoie;
    }

    /**
     * @param string $nomVoieComplet
     */
    public function setNomVoieComplet($nomVoieComplet)
    {
        $this->nomVoieComplet = $nomVoieComplet;
    }

    /**
     * @return string
     */
    public function getNomVoieComplet()
    {
        return $this->nomVoieComplet;
    }

    /**
     * @param string $typeVoie
     */
    public function setTypeVoie($typeVoie)
    {
        $this->typeVoie = $typeVoie;
    }

    /**
     * @return string
     */
    public function getTypeVoie()
    {
        return $this->typeVoie;
    }

}
