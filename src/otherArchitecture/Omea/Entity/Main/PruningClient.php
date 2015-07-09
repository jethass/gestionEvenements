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
 * Omea\Entity\PruningClient
 *
 * @ORM\Table(name="PRUNING_CLIENT")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\PruningClientRepository")
 */

class PruningClient
{
    /**
     * @var integer $idPruningClient
     * @ORM\Id
     * @ORM\Column(name="ID_PRUNING_CLIENT", type="integer")
     */
    private $idPruningClient;

    /**
     * @var PruningParametrage $PruningParametrage
     *
     * @ORM\ManyToOne(targetEntity="PruningParametrage")
     * @ORM\JoinColumn(name="ID_PRUNING_PARAMETRAGE", referencedColumnName = "ID_PRUNING_PARAMETRAGE")
     */
    private $pruningParametrage;
    
    /**
     * @var integer $idPruningParametrage
     *
     * @ORM\Column(name="ID_PRUNING_PARAMETRAGE", type="integer")
     */
    private $idPruningParametrage;

    /**
     * @var Client $client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT")
     */
    private $client;
    
    /**
     * @var integer $idClient
     *
     * @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     * @var \DateTime $dateMigrationTheorique
     *
     * @ORM\Column(name="DATE_MIGRATION_THEORIQUE", type="date")
     */
    private $dateMigrationTheorique;

    /**
     * @var integer $idMig
     *
     * @ORM\Column(name="ID_MIG", type="integer")
     */
    private $idMig;

    /**
     * @return int
     */
    public function getIdPruningClient()
    {
        return $this->idPruningClient;
    }

    /**
     * @param int $idPruningClient
     */
    public function setIdPruningClient($idPruningClient)
    {
        $this->idPruningClient = $idPruningClient;
    }

    /**
     * @return PruningParametrage
     */
    public function getPruningParametrage()
    {
        return $this->pruningParametrage;
    }

    /**
     * @param PruningParametrage $pruningParametrage
     */
    public function setPruningParametrage($pruningParametrage)
    {
        $this->pruningParametrage = $pruningParametrage;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return \DateTime
     */
    public function getDateMigrationTheorique()
    {
        return $this->dateMigrationTheorique;
    }

    /**
     * @param \DateTime $dateMigrationTheorique
     */
    public function setDateMigrationTheorique($dateMigrationTheorique)
    {
        $this->dateMigrationTheorique = $dateMigrationTheorique;
    }

    /**
     * @return int
     */
    public function getIdMig()
    {
        return $this->idMig;
    }

    /**
     * @param int $idMig
     */
    public function setIdMig($idMig)
    {
        $this->idMig = $idMig;
    }

    /**
     * @return integer
     */
    function getIdPruningParametrage()
    {
        return $this->idPruningParametrage;
    }

    /**
     * @return integer
     */
    function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param integer $idPruningParametrage
     */
    function setIdPruningParametrage($idPruningParametrage)
    {
        $this->idPruningParametrage = $idPruningParametrage;
    }

    /**
     * @param integer $idClient
     */
    function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }
}