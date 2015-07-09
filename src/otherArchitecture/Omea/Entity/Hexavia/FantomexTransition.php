<?php

namespace Omea\Entity\Hexavia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FantomexTransition
 *
 * @ORM\Table(name="FANTOMEX_TRANSITION", indexes={@ORM\Index(name="IDX_FROM_TOPO", columns={"FROM_CODE_DIRECTION", "FROM_CODE_COMMUNE", "FROM_CODE_DEPARTEMENT", "FROM_CODE_RIVOLI", "FROM_NUM_IMMEUBLE"}), @ORM\Index(name="IDX_TO_TOPO", columns={"TO_NUM_IMMEUBLE", "TO_CODE_COMMUNE", "TO_CODE_RIVOLI", "TO_CODE_DEPARTEMENT", "TO_CODE_DIRECTION"})})
 * @ORM\Entity
 */
class FantomexTransition
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
     * @ORM\Column(name="FROM_CODE_DEPARTEMENT", type="string", length=2, nullable=false)
     */
    private $fromCodeDepartement;

    /**
     * @var integer
     *
     * @ORM\Column(name="FROM_CODE_DIRECTION", type="integer", nullable=false)
     */
    private $fromCodeDirection;

    /**
     * @var integer
     *
     * @ORM\Column(name="FROM_CODE_COMMUNE", type="integer", nullable=false)
     */
    private $fromCodeCommune;

    /**
     * @var string
     *
     * @ORM\Column(name="FROM_CODE_RIVOLI", type="string", length=4, nullable=false)
     */
    private $fromCodeRivoli;

    /**
     * @var integer
     *
     * @ORM\Column(name="FROM_NUM_IMMEUBLE", type="integer", nullable=false)
     */
    private $fromNumImmeuble;

    /**
     * @var string
     *
     * @ORM\Column(name="TO_CODE_DEPARTEMENT", type="string", length=2, nullable=false)
     */
    private $toCodeDepartement;

    /**
     * @var integer
     *
     * @ORM\Column(name="TO_CODE_DIRECTION", type="integer", nullable=false)
     */
    private $toCodeDirection;

    /**
     * @var integer
     *
     * @ORM\Column(name="TO_CODE_COMMUNE", type="integer", nullable=false)
     */
    private $toCodeCommune;

    /**
     * @var string
     *
     * @ORM\Column(name="TO_CODE_RIVOLI", type="string", length=4, nullable=false)
     */
    private $toCodeRivoli;

    /**
     * @var integer
     *
     * @ORM\Column(name="TO_NUM_IMMEUBLE", type="integer", nullable=false)
     */
    private $toNumImmeuble;

    /**
     * @var integer
     *
     * @ORM\Column(name="DATE_TOPAD", type="integer", nullable=false)
     */
    private $dateTopad;

    /**
     * @var integer
     *
     * @ORM\Column(name="CODE_RANG", type="integer", nullable=false)
     */
    private $codeRang;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE_MAJ", type="string", length=1, nullable=false)
     */
    private $typeMaj;

    /**
     * @param int $codeRang
     */
    public function setCodeRang($codeRang)
    {
        $this->codeRang = $codeRang;
    }

    /**
     * @return int
     */
    public function getCodeRang()
    {
        return $this->codeRang;
    }

    /**
     * @param int $dateTopad
     */
    public function setDateTopad($dateTopad)
    {
        $this->dateTopad = $dateTopad;
    }

    /**
     * @return int
     */
    public function getDateTopad()
    {
        return $this->dateTopad;
    }

    /**
     * @param int $fromCodeCommune
     */
    public function setFromCodeCommune($fromCodeCommune)
    {
        $this->fromCodeCommune = $fromCodeCommune;
    }

    /**
     * @return int
     */
    public function getFromCodeCommune()
    {
        return $this->fromCodeCommune;
    }

    /**
     * @param string $fromCodeDepartement
     */
    public function setFromCodeDepartement($fromCodeDepartement)
    {
        $this->fromCodeDepartement = $fromCodeDepartement;
    }

    /**
     * @return string
     */
    public function getFromCodeDepartement()
    {
        return $this->fromCodeDepartement;
    }

    /**
     * @param int $fromCodeDirection
     */
    public function setFromCodeDirection($fromCodeDirection)
    {
        $this->fromCodeDirection = $fromCodeDirection;
    }

    /**
     * @return int
     */
    public function getFromCodeDirection()
    {
        return $this->fromCodeDirection;
    }

    /**
     * @param string $fromCodeRivoli
     */
    public function setFromCodeRivoli($fromCodeRivoli)
    {
        $this->fromCodeRivoli = $fromCodeRivoli;
    }

    /**
     * @return string
     */
    public function getFromCodeRivoli()
    {
        return $this->fromCodeRivoli;
    }

    /**
     * @param int $fromNumImmeuble
     */
    public function setFromNumImmeuble($fromNumImmeuble)
    {
        $this->fromNumImmeuble = $fromNumImmeuble;
    }

    /**
     * @return int
     */
    public function getFromNumImmeuble()
    {
        return $this->fromNumImmeuble;
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
     * @param int $toCodeCommune
     */
    public function setToCodeCommune($toCodeCommune)
    {
        $this->toCodeCommune = $toCodeCommune;
    }

    /**
     * @return int
     */
    public function getToCodeCommune()
    {
        return $this->toCodeCommune;
    }

    /**
     * @param string $toCodeDepartement
     */
    public function setToCodeDepartement($toCodeDepartement)
    {
        $this->toCodeDepartement = $toCodeDepartement;
    }

    /**
     * @return string
     */
    public function getToCodeDepartement()
    {
        return $this->toCodeDepartement;
    }

    /**
     * @param int $toCodeDirection
     */
    public function setToCodeDirection($toCodeDirection)
    {
        $this->toCodeDirection = $toCodeDirection;
    }

    /**
     * @return int
     */
    public function getToCodeDirection()
    {
        return $this->toCodeDirection;
    }

    /**
     * @param string $toCodeRivoli
     */
    public function setToCodeRivoli($toCodeRivoli)
    {
        $this->toCodeRivoli = $toCodeRivoli;
    }

    /**
     * @return string
     */
    public function getToCodeRivoli()
    {
        return $this->toCodeRivoli;
    }

    /**
     * @param int $toNumImmeuble
     */
    public function setToNumImmeuble($toNumImmeuble)
    {
        $this->toNumImmeuble = $toNumImmeuble;
    }

    /**
     * @return int
     */
    public function getToNumImmeuble()
    {
        return $this->toNumImmeuble;
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
