<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="RESILIATION")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ResiliationRepository")
 */
class Resiliation
{

    /**
     *
     * @var integer $idResiliation
     * @ORM\Column(name="ID_RESILIATION", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idResiliation;

    /**
     *
     * @var integer $idClient
     * @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     *
     * @var date $idclient
     * @ORM\Column(name="DATE_RESILIATION", type="date")
     */
    private $dateResiliation;

    /**
     *
     * @var integer $typeResil
     * @ORM\Column(name="TYPE_RESIL", type="integer")
     */
    private $typeResil;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="resiliations")
     * @ORM\JoinColumn(name="ID_CLIENT", referencedColumnName="ID_CLIENT", nullable=false)
     */
    private $client;

    /**
     * @return the $idResiliation
     */
    public function getIdResiliation()
    {
        return $this->idResiliation;
    }

    /**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @return the $dateResiliation
     */
    public function getDateResiliation()
    {
        return $this->dateResiliation;
    }

    /**
     * @return the $typeResil
     */
    public function getTypeResil()
    {
        return $this->typeResil;
    }

    /**
     * @return boolean
     */
    public function isTypePrepaye()
    {
        return $this->getTypeResil() == 4;
    }

    /**
     * @param integer $idResiliation
     */
    public function setIdResiliation($idResiliation)
    {
        $this->idResiliation = $idResiliation;
    }

    /**
     * @param integer $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @param date $dateResiliation
     */
    public function setDateResiliation($dateResiliation)
    {
        $this->dateResiliation = $dateResiliation;
    }

    /**
     * @param integer $typeResil
     */
    public function setTypeResil($typeResil)
    {
        $this->typeResil = $typeResil;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

}
