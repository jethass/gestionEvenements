<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="REFERENTIEL_MATERIELS")
 * @ORM\Entity
 */
class ReferentielMateriels
{

    /**
     *      @ORM\Column(name="ID_REFERENCE_MATERIELS", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idReferenceMateriels;

    /**
     *      @ORM\Column(name="TYPE", type="string")
     */
    private $type;

    /**
     *      @ORM\Column(name="ID_ART", type="integer")
     */
    private $idArt;

    /**
     *      @ORM\Column(name="REFERENCE", type="integer")
     */
    private $reference;
    
	/**
     * @return the $idReferenceMateriels
     */
    public function getIdReferenceMateriels()
    {
        return $this->idReferenceMateriels;
    }

	/**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

	/**
     * @return the $idArt
     */
    public function getIdArt()
    {
        return $this->idArt;
    }

	/**
     * @return the $reference
     */
    public function getReference()
    {
        return $this->reference;
    }

	/**
     * @param field_type $idReferenceMateriels
     */
    public function setIdReferenceMateriels($idReferenceMateriels)
    {
        $this->idReferenceMateriels = $idReferenceMateriels;
    }

	/**
     * @param field_type $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

	/**
     * @param field_type $idArt
     */
    public function setIdArt($idArt)
    {
        $this->idArt = $idArt;
    }

	/**
     * @param field_type $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

}
