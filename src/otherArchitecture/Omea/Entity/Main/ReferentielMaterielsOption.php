<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="REFERENTIEL_MATERIELS_OPTION")
 * @ORM\Entity
 */
class ReferentielMaterielsOption
{

    /**
     *      @ORM\Column(name="ID_REFERENCE_MATERIELS_OPTION", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idReferenceMaterielsOption;

    /**
     *      @ORM\Column(name="ID_ART_MATERIEL", type="integer")
     */
    private $idArtMateriel;

    /**
     *      @ORM\Column(name="ID_OPTION", type="integer")
     */
    private $idOption;
    
	/**
     * @return the $idReferenceMaterielsOption
     */
    public function getIdReferenceMaterielsOption()
    {
        return $this->idReferenceMaterielsOption;
    }

	/**
     * @return the $idArtMateriel
     */
    public function getIdArtMateriel()
    {
        return $this->idArtMateriel;
    }

	/**
     * @return the $idOption
     */
    public function getIdOption()
    {
        return $this->idOption;
    }

	/**
     * @param field_type $idReferenceMaterielsOption
     */
    public function setIdReferenceMaterielsOption($idReferenceMaterielsOption)
    {
        $this->idReferenceMaterielsOption = $idReferenceMaterielsOption;
    }

	/**
     * @param field_type $idArtMateriel
     */
    public function setIdArtMateriel($idArtMateriel)
    {
        $this->idArtMateriel = $idArtMateriel;
    }

	/**
     * @param field_type $idOption
     */
    public function setIdOption($idOption)
    {
        $this->idOption = $idOption;
    }

    	
}
