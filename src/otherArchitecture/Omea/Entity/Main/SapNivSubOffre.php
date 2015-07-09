<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="SAP_NIV_SUB_OFFRE")
 * @ORM\Entity
 */
class SapNivSubOffre
{

    /**
     * @ORM\Column(name="ID_NIV_SUB", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idNivsub;

    /**
     * @ORM\Column(name="NIV_SUB", type="string", length=18)
     */
    private $nivSub;

    /**
     * @ORM\Column(name="DESIGNATION", type="string", length=255)
     */
    private $designation;

    /**
     * @return the $idNivsub
     */
    public function getIdNivsub()
    {
        return $this->idNivsub;
    }

    /**
     * @return the $nivSub
     */
    public function getNivSub()
    {
        return $this->nivSub;
    }

    /**
     * @return the $designation
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param field_type $idNivsub
     */
    public function setIdNivsub($idNivsub)
    {
        $this->idNivsub = $idNivsub;
    }

    /**
     * @param field_type $nivSub
     */
    public function setNivSub($nivSub)
    {
        $this->nivSub = $nivSub;
    }

    /**
     * @param field_type $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

}
