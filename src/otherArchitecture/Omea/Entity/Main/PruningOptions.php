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
 * Omea\Entity\PruningOptions
 *
 * @ORM\Table(name="PRUNING_OPTIONS")
 * @ORM\Entity
 */
class PruningOptions
{
    /**
     * @var integer $idPruningOptions
     * @ORM\Id
     * @ORM\Column(name="ID_PRUNING_OPTIONS", type="integer")
     */
    private $idPruningOptions;

    /**
     * @var integer $pruningParametrage
     * @ORM\ManyToOne(targetEntity="PruningParametrage")
     * @ORM\JoinColumn(name="ID_PRUNING_PARAMETRAGE", referencedColumnName="ID_PRUNING_PARAMETRAGE")
     */
    private $pruningParametrage;

    /**
     * @var integer $idPruningParametrage
     * @ORM\Column(name="ID_PRUNING_PARAMETRAGE", type="integer")
     */
    private $idPruningParametrage;

    /**
     * @var ForfaitOptions $forfaitOption
     * @ORM\ManyToOne(targetEntity="ForfaitOptions")
     * @ORM\JoinColumn(name="ID_FORFAIT_OPTION", referencedColumnName="ID_FORFAIT_OPTION")
     */
    private $forfaitOption;

    /**
     * @return int
     */
    public function getIdPruningOptions()
    {
        return $this->idPruningOptions;
    }

    /**
     * @param int $idPruningOptions
     */
    public function setIdPruningOptions($idPruningOptions)
    {
        $this->idPruningOptions = $idPruningOptions;
    }

    /**
     * @return int
     */
    public function getPruningParametrage()
    {
        return $this->pruningParametrage;
    }

    /**
     * @param int $pruningParametrage
     */
    public function setPruningParametrage($pruningParametrage)
    {
        $this->pruningParametrage = $pruningParametrage;
    }

    /**
     * @return ForfaitOptions
     */
    public function getForfaitOption()
    {
        return $this->forfaitOption;
    }

    /**
     * @param ForfaitOptions $forfaitOption
     */
    public function setForfaitOption($forfaitOption)
    {
        $this->forfaitOption = $forfaitOption;
    }

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



}