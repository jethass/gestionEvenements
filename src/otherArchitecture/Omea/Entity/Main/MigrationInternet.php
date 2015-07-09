<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="MIGRATION_INTERNET")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\MigrationInternetRepository")
 */
class MigrationInternet
{

    /**
     *      @ORM\Column(name="ID_MIGRATION_INTERNET", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idMigrationInternet;

    /**
     *      @ORM\Column(name="OFFRE_SOURCE", type="string")
     */
    private $offreSource;

    /**
     *      @ORM\Column(name="OFFRE_CIBLE", type="string")
     */
    private $offreCible;

    /**
     *      @ORM\Column(name="CANAL", type="string")
     */
    private $canal;

    /**
     * @ORM\ManyToMany(targetEntity="Forfait", inversedBy="migrationInternetSource")
     * @ORM\JoinColumn(name="OFFRE_SOURCE", referencedColumnName = "REF_SAP")
     */
    private $forfaitSource;

    /**
     * @ORM\ManyToMany(targetEntity="Forfait", inversedBy="migrationInternetCible")
     * @ORM\JoinColumn(name="OFFRE_CIBLE", referencedColumnName = "REF_SAP")
     */
    private $forfaitCible;

    /**
     * @ORM\OneToMany(targetEntity="ReferentielMaterielsForfait", mappedBy="migrationInternetCible")
     * @ORM\JoinColumn(name="OFFRE_CIBLE", referencedColumnName = "ID_ART_FORFAIT")
     */
    private $referentielMaterielsForfait;

	/**
     * @return the $referentielMaterielsForfait
     */
    public function getReferentielMaterielsForfait()
    {
        return $this->referentielMaterielsForfait;
    }

	/**
     * @param field_type $referentielMaterielsForfait
     */
    public function setReferentielMaterielsForfait($referentielMaterielsForfait)
    {
        $this->referentielMaterielsForfait = $referentielMaterielsForfait;
    }
	/**
     * @return the $forfaitSource
     */
    public function getForfaitSource()
    {
        return $this->forfaitSource;
    }

	/**
     * @return the $forfaitCible
     */
    public function getForfaitCible()
    {
        return $this->forfaitCible;
    }

	/**
     * @param field_type $forfaitSource
     */
    public function setForfaitSource($forfaitSource)
    {
        $this->forfaitSource = $forfaitSource;
    }

	/**
     * @param field_type $forfaitCible
     */
    public function setForfaitCible($forfaitCible)
    {
        $this->forfaitCible = $forfaitCible;
    }

	/**
     * @return the $idMigrationInternet
     */
    public function getIdMigrationInternet()
    {
        return $this->idMigrationInternet;
    }

	/**
     * @return the $offreSource
     */
    public function getOffreSource()
    {
        return $this->offreSource;
    }

	/**
     * @return the $offreCible
     */
    public function getOffreCible()
    {
        return $this->offreCible;
    }

	/**
     * @return the $canal
     */
    public function getCanal()
    {
        return $this->canal;
    }

	/**
     * @param field_type $idMigrationInternet
     */
    public function setIdMigrationInternet($idMigrationInternet)
    {
        $this->idMigrationInternet = $idMigrationInternet;
    }

	/**
     * @param field_type $offreSource
     */
    public function setOffreSource($offreSource)
    {
        $this->offreSource = $offreSource;
    }

	/**
     * @param field_type $offreCible
     */
    public function setOffreCible($offreCible)
    {
        $this->offreCible = $offreCible;
    }

	/**
     * @param field_type $canal
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;
    }


}
