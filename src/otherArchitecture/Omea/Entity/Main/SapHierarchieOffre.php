<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="SAP_HIERARCHIE_OFFRE")
 * @ORM\Entity
 */
class SapHierarchieOffre
{

    /**
     * @ORM\Column(name="ID_HIER_OFFRE", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idHierOffre;

    /**
     * @ORM\Column(name="GAMME", type="string", length=18)
     */
    private $gamme;

    /**
     * @ORM\Column(name="SS_GAMME", type="string", length=18)
     */
    private $ssGamme;

    /**
     * @ORM\Column(name="NIV_REM_OFFRE", type="string", length=18)
     */
    private $nivRemOffre;

    /**
     * @return the $idHierOffre
     */
    public function getIdHierOffre()
    {
        return $this->idHierOffre;
    }

    /**
     * @return the $gamme
     */
    public function getGamme()
    {
        return $this->gamme;
    }

    /**
     * @return the $ssGamme
     */
    public function getSsGamme()
    {
        return $this->ssGamme;
    }

    /**
     * @return the $nivRemOffre
     */
    public function getNivRemOffre()
    {
        return $this->nivRemOffre;
    }

    /**
     * @param field_type $idHierOffre
     */
    public function setIdHierOffre($idHierOffre)
    {
        $this->idHierOffre = $idHierOffre;
    }

    /**
     * @param field_type $gamme
     */
    public function setGamme($gamme)
    {
        $this->gamme = $gamme;
    }

    /**
     * @param field_type $ssGamme
     */
    public function setSsGamme($ssGamme)
    {
        $this->ssGamme = $ssGamme;
    }

    /**
     * @param field_type $nivRemOffre
     */
    public function setNivRemOffre($nivRemOffre)
    {
        $this->nivRemOffre = $nivRemOffre;
    }

}
