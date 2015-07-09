<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="CLIENT_BLOQUE")
 * @ORM\Entity(repositoryClass="Omea\Entity\Main\ClientBloqueRepository")
 */
class ClientBloque
{

    /**
     *
     * @var integer $idClientBloque
     *
     *      @ORM\Column(name="ID_CLIENT_BLOQUE", type="integer")
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idClientBloque;

    /**
     *
     * @var integer $idClient
     *
     *      @ORM\Column(name="ID_CLIENT", type="integer")
     */
    private $idClient;

    /**
     *
     * @var integer $tentatives
     *
     *      @ORM\Column(name="TENTATIVES", type="integer")
     */
    private $tentatives;

    /**
     *
     * @var string $jeton
     *
     *      @ORM\Column(name="JETON", type="string")
     */
    private $jeton;

    /**
     *
     * @var datetime $dateDeblocage
     *
     *      @ORM\Column(name="DATE_DEBLOCAGE", type="datetime")
     */
    private $dateDeblocage;

    /**
     *
     * @var datetime $dateBlocage
     *
     *      @ORM\Column(name="DATE_BLOCAGE", type="datetime")
     */
    private $dateBlocage;

    /**
     * @return the $idClientBloque
     */
    public function getIdClientBloque()
    {
        return $this->idClientBloque;
    }

    /**
     * @return the $idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @return the $tentatives
     */
    public function getTentatives()
    {
        return $this->tentatives;
    }

    /**
     * @return the $jeton
     */
    public function getJeton()
    {
        return $this->jeton;
    }

    /**
     * @return the $dateDeblocage
     */
    public function getDateDeblocage()
    {
        return $this->dateDeblocage;
    }

    /**
     * @return the $dateBlocage
     */
    public function getDateBlocage()
    {
        return $this->dateBlocage;
    }

    /**
     * @param number $idClientBloque
     */
    public function setIdClientBloque($idClientBloque)
    {
        $this->idClientBloque = $idClientBloque;
    }

    /**
     * @param number $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @param number $tentatives
     */
    public function setTentatives($tentatives)
    {
        $this->tentatives = $tentatives;
    }

    /**
     * @param string $jeton
     */
    public function setJeton($jeton)
    {
        $this->jeton = $jeton;
    }

    /**
     * @param \Omea\Entity\Main\datetime $dateDeblocage
     */
    public function setDateDeblocage($dateDeblocage)
    {
        $this->dateDeblocage = $dateDeblocage;
    }

    /**
     * @param \Omea\Entity\Main\datetime $dateBlocage
     */
    public function setDateBlocage($dateBlocage)
    {
        $this->dateBlocage = $dateBlocage;
    }

}
