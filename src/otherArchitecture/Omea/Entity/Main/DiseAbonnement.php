<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="DISE_ABONNEMENT")
 * @ORM\Entity
 */
class DiseAbonnement
{
    /**
     * @var integer $numAbo
     * @ORM\OneToMany(targetEntity="DiseAbonnement", mappedBy="diseAbonnement")
     * @ORM\Column(name="NUM_ABO", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $numAbo;

    /**
     * @ORM\Column(name="NUM_COMPTE_DISE", type="string", length=8)
     */
    private $numCompteDise;

    /**
     * @ORM\Column(name="CODE_TARIF", type="string", length=6)
     */
    private $codeTarif;

    /**
     * @ORM\Column(name="STATUT_ABONNEMENT", type="string", length=3)
     */
    private $statutAbonnement;

    /**
     * @ORM\OneToMany(targetEntity="StockMsisdn", mappedBy="diseAbonnement")
     * @ORM\JoinColumn(name="NUM_ABO", referencedColumnName="NUM_ABO")
     *
     */
    private $stockMsisdn;

    /**
     * @ORM\OneToOne(targetEntity="DisePackage")
     * @ORM\JoinColumn(name="CODE_PACKAGE", referencedColumnName="CODE_PACKAGE")
     *
     */
    private $disePackage;

    /**
     * @ORM\Column(name="DATE_DERN_MAJ", type="datetime")
     */
    private $dateDernMaj;

    /**
     * @ORM\Column(name="ID_HNO", type="integer")
     */
    private $idHno;

    /**
     * @ORM\OneToMany(targetEntity="DiseModificationEtatAbonne", mappedBy="diseAbonnement")
     */
    private $diseModificationEtatAbonnes;

    public function __construct()
    {
        $this->diseModificationEtatAbonnes = new ArrayCollection();
    }

    /**
     * @return the $codeTarif
     */
    public function getCodeTarif()
    {
        return $this->codeTarif;
    }

    /**
     * @param field_type $codeTarif
     */
    public function setCodeTarif($codeTarif)
    {
        $this->codeTarif = $codeTarif;
    }

    /**
     * @return the $idHno
     */
    public function getIdHno()
    {
        return $this->idHno;
    }

    /**
     * @param field_type $idHno
     */
    public function setIdHno($idHno)
    {
        $this->idHno = $idHno;
    }

    /**
     * @return the $stockMsisdn
     */
    public function getStockMsisdn()
    {
        return $this->stockMsisdn;
    }

    /**
     * @return the $disePackage
     */
    public function getDisePackage()
    {
        return $this->disePackage;
    }

    /**
     * @return the $dateDernMaj
     */
    public function getDateDernMaj()
    {
        return $this->dateDernMaj;
    }

    /**
     * @param field_type $stockMsisdn
     */
    public function setStockMsisdn($stockMsisdn)
    {
        $this->stockMsisdn = $stockMsisdn;
    }

    /**
     * @param field_type $disePackage
     */
    public function setDisePackage($disePackage)
    {
        $this->disePackage = $disePackage;
    }

    /**
     * @param field_type $dateDernMaj
     */
    public function setDateDernMaj($dateDernMaj)
    {
        $this->dateDernMaj = $dateDernMaj;
    }

    /**
     * @return the $numAbo
     */
    public function getNumAbo()
    {
        return $this->numAbo;
    }

    /**
     * @return the $numCompteDise
     */
    public function getNumCompteDise()
    {
        return $this->numCompteDise;
    }

    /**
     * @return the $statutAbonnement
     */
    public function getStatutAbonnement()
    {
        return $this->statutAbonnement;
    }

    /**
     * @return the $stockMsisdn
     */
    public function getSockMsisdn()
    {
        return $this->stockMsisdn;
    }

    /**
     * @param number $numAbo
     */
    public function setNumAbo($numAbo)
    {
        $this->numAbo = $numAbo;
    }

    /**
     * @param field_type $numCompteDise
     */
    public function setNumCompteDise($numCompteDise)
    {
        $this->numCompteDise = $numCompteDise;
    }

    /**
     * @param field_type $statutAbonnement
     */
    public function setStatutAbonnement($statutAbonnement)
    {
        $this->statutAbonnement = $statutAbonnement;
    }

    /**
     * @return ArrayCollection
     */
    public function getDiseModificationEtatAbonnes()
    {
        return $this->diseModificationEtatAbonnes;
    }

}
