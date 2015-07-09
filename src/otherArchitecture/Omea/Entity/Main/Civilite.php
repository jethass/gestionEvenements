<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CIVILITE")
 * @ORM\Entity
 */
class Civilite
{

    /**
     *
     * @var integer $idCivilite
     *
     *      @ORM\Column(name="ID_CIV", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCiv;

    /**
     *
     * @var string $libelle
     *
     *      @ORM\Column(name="LIBELLE", type="string", length=10)
     */
    private $libelle;

    /**
     *
     * @var string $civSisteer
     *
     *      @ORM\Column(name="CIV_SISTEER", type="smallint")
     */
    private $civSisteer;

    /**
     *
     * @var string $civPnm
     *
     *      @ORM\Column(name="CIV_PNM", type="string", length=4)
     */
    private $civPnm;

    /**
     *
     * @var string $civSap
     *
     *      @ORM\Column(name="CIV_SAP", type="string", length=4)
     */
    private $civSap;

    /**
     *
     * @return the $idCivilite
     */
    public function getIdCiv()
    {
        return $this->idCiv;
    }

    /**
     *
     * @return the $libelle
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     *
     * @return the $civiliteSisteer
     */
    public function getCivisteer()
    {
        return $this->civSisteer;
    }

    /**
     *
     * @return the $civilitePnm
     */
    public function getCivPnm()
    {
        return $this->civPnm;
    }

    /**
     *
     * @return the $civiliteSap
     */
    public function getCivSap()
    {
        return $this->civSap;
    }

    /**
     *
     * @param number $idCivilite
     */
    public function setIdCiv($idCiv)
    {
        $this->idCiv = $idCiv;
    }

    /**
     *
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     *
     * @param string $civiliteSisteer
     */
    public function setCivSisteer($civSisteer)
    {
        $this->civSisteer = $civSisteer;
    }

    /**
     *
     * @param string $civilitePnm
     */
    public function setCivPnm($civPnm)
    {
        $this->civPnm = $civPnm;
    }

    /**
     *
     * @param string $civiliteSap
     */
    public function setCivSap($civSap)
    {
        $this->civSap = $civSap;
    }
}
