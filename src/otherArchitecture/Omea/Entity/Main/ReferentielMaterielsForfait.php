<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="REFERENTIEL_MATERIELS_FORFAIT")
 * @ORM\Entity
 */
class ReferentielMaterielsForfait
{

    /**
     *      @ORM\Column(name="ID_REFERENCE_MATERIELS_FORFAIT", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idReferenceMaterielsForfait;

    /**
     *      @ORM\Column(name="ID_ART_MATERIEL", type="integer")
     */
    private $idArtMateriel;

    /**
     *      @ORM\Column(name="ID_ART_FORFAIT", type="integer")
     */
    private $idArtForfait;
    
    /**
     *      @ORM\Column(name="CANAL_ACCES", type="string")
     */
    private $canalAcces;
    
    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="referentielMaterielsForfait")
     * @ORM\JoinColumn(name="ID_ART_FORFAIT", referencedColumnName = "ID_ART")
     */
    private $articleForfait;
    
	/**
     * @return the $migrationInternetCible
     */
    public function getMigrationInternetCible()
    {
        return $this->migrationInternetCible;
    }

	/**
     * @param field_type $migrationInternetCible
     */
    public function setMigrationInternetCible($migrationInternetCible)
    {
        $this->migrationInternetCible = $migrationInternetCible;
    }

	/**
     * @return the $idReferenceMaterielsForfait
     */
    public function getIdReferenceMaterielsForfait()
    {
        return $this->idReferenceMaterielsForfait;
    }

	/**
     * @return the $idArtMateriel
     */
    public function getIdArtMateriel()
    {
        return $this->idArtMateriel;
    }

	/**
     * @return the $idArtForfait
     */
    public function getIdArtForfait()
    {
        return $this->idArtForfait;
    }

	/**
     * @return the $canalAcces
     */
    public function getCanalAcces()
    {
        return $this->canalAcces;
    }

	/**
     * @param field_type $idReferenceMaterielsForfait
     */
    public function setIdReferenceMaterielsForfait($idReferenceMaterielsForfait)
    {
        $this->idReferenceMaterielsForfait = $idReferenceMaterielsForfait;
    }

	/**
     * @param field_type $idArtMateriel
     */
    public function setIdArtMateriel($idArtMateriel)
    {
        $this->idArtMateriel = $idArtMateriel;
    }

	/**
     * @param field_type $idArtForfait
     */
    public function setIdArtForfait($idArtForfait)
    {
        $this->idArtForfait = $idArtForfait;
    }

	/**
     * @param field_type $canalAcces
     */
    public function setCanalAcces($canalAcces)
    {
        $this->canalAcces = $canalAcces;
    }

	
}
