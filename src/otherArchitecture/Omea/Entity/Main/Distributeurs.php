<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="DISTRIBUTEURS")
 * @ORM\Entity
 */
class Distributeurs
{
    /**
     * @var integer $idDis
     * @ORM\Column(name="ID_DIS", type="integer")
     * @ORM\Id
     */
    private $idDis;

    /**
     * @var integer $idMag
     * @ORM\Column(name="ID_MAG", type="integer")
     * @ORM\Id
     */
    private $idMag;

    /**
     * @var string $enseigne
     * @ORM\Column(name="ENSEIGNE", type="string")
     */
    private $enseigne;

    /**
     * @var string $societe
     * @ORM\Column(name="SOCIETE", type="string")
     */
    private $societe;

    /**
     * @var string $idMc
     * @ORM\Column(name="ID_MC", type="integer")
     */
    private $idMc;

    /**
     * @ORM\Column(name="TYPE_CANAL", type="string")
     */
    private $typeCanal;

    /**
     * @ORM\Column(name="CANAL_SAP", type="integer")
     */
    private $canalSap;

    /**
     * @ORM\Column(name="AGENCE_COMMERCIAL_SAP", type="string", length=5)
     */
    private $agenceCommercialSap;

    /**
     * @return the $agenceCommercialSap
     */
    public function getAgenceCommercialSap()
    {
        return $this->agenceCommercialSap;
    }

    /**
     * @param field_type $agenceCommercialSap
     */
    public function setAgenceCommercialSap($agenceCommercialSap)
    {
        $this->agenceCommercialSap = $agenceCommercialSap;
    }

    /**
     * @return the $canalSap
     */
    public function getCanalSap()
    {
        return $this->canalSap;
    }

    /**
     * @param field_type $canalSap
     */
    public function setCanalSap($canalSap)
    {
        $this->canalSap = $canalSap;
    }

    /**
     * @return the $idDis
     */
    public function getIdDis()
    {
        return $this->idDis;
    }

    /**
     * @return the $idMag
     */
    public function getIdMag()
    {
        return $this->idMag;
    }

    /**
     * @return the $enseigne
     */
    public function getEnseigne()
    {
        return $this->enseigne;
    }

    /**
     * @return the $societe
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * @return the $idMc
     */
    public function getIdMc()
    {
        return $this->idMc;
    }

    /**
     * @return the $typeCanal
     */
    public function getTypeCanal()
    {
        return $this->typeCanal;
    }

    /**
     * @param integer $idDis
     */
    public function setIdDis($idDis)
    {
        $this->idDis = $idDis;
    }

    /**
     * @param integer $idMag
     */
    public function setIdMag($idMag)
    {
        $this->idMag = $idMag;
    }

    /**
     * @param string $enseigne
     */
    public function setEnseigne($enseigne)
    {
        $this->enseigne = $enseigne;
    }

    /**
     * @param string $societe
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;
    }

    /**
     * @param string $idMc
     */
    public function setIdMc($idMc)
    {
        $this->idMc = $idMc;
    }

    /**
     * @param field_type $typeCanal
     */
    public function setTypeCanal($typeCanal)
    {
        $this->typeCanal = $typeCanal;
    }

}
