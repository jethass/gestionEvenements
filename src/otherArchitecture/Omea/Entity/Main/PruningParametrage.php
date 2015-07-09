<?php
/**
 * Created by PhpStorm.
 * User: smekkaoui
 * Date: 02/06/2015
 * Time: 17:31
 */

namespace Omea\Entity\Main;
use Doctrine\ORM\Mapping as ORM;

/**
 * Omea\Entity\PruningParametrage
 *
 * @ORM\Table(name="PRUNING_PARAMETRAGE")
 * @ORM\Entity
 */
class PruningParametrage
{
    /**
     * @var integer $idPruningParametrage
     * @ORM\Id
     * @ORM\Column(name="ID_PRUNING_PARAMETRAGE", type="integer")
     */
    private $idPruningParametrage;

    /**
     * @var Forfait $forfaitOrigine
     * @ORM\ManyToOne(targetEntity="Forfait")
     * @ORM\JoinColumn(name="OFFRE_ID_ORIGINE", referencedColumnName="offre_id")
     */
    private $forfaitOrigine;

    /**
     * @var Forfait $forfaitDestination
     * @ORM\ManyToOne(targetEntity="Forfait")
     * @ORM\JoinColumn(name="OFFRE_ID_CIBLE", referencedColumnName="offre_id")
     */
    private $forfaitCible;

    /**
     * @var boolean $actif
     * @ORM\Column(name="ACTIF", type="boolean")
     */
    private $actif;

    /**
     * @var integer $priorite
     * @ORM\Column(name="PRIORITE", type="integer")
     */
    private $priorite;

    /**
     * @return int
     */
    public function getIdPruningParametrage()
    {
        return $this->idPruningParametrage;
    }

    /**
     * @param int $idPruningParametrage
     */
    public function setIdPruningParametrage($idPruningParametrage)
    {
        $this->idPruningParametrage = $idPruningParametrage;
    }

    /**
     * @return Forfait
     */
    public function getForfaitOrigine()
    {
        return $this->forfaitOrigine;
    }

    /**
     * @param Forfait $forfaitOrigine
     */
    public function setForfaitOrigine($forfaitOrigine)
    {
        $this->forfaitOrigine = $forfaitOrigine;
    }

    /**
     * @return Forfait
     */
    public function getForfaitCible()
    {
        return $this->forfaitCible;
    }

    /**
     * @param Forfait $forfaitCible
     */
    public function setForfaitCible($forfaitCible)
    {
        $this->forfaitCible = $forfaitCible;
    }

    /**
     * @return boolean
     */
    public function isActif()
    {
        return $this->actif;
    }

    /**
     * @param boolean $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * @return int
     */
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * @param int $priorite
     */
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;
    }
}