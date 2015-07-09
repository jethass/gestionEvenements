<?php

namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="STOCKAGE_ELIGIBILITE_FICHIER")
 */
class StockageEligibiliteFichier {

    const TYPE_CLIENT_INTERNET = 'F';
    const TYPE_CLIENT_MOBILE_VM = 'MOV';
    const TYPE_CLIENT_MOBILE_GROUP = 'MOG';

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="ID_CLIENT", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var integer
     * @ORM\Column(name="ELIG_FTTLA", type="integer", nullable=false)
     */
    private $eligFttla;

    /**
     * @var integer
     * @ORM\Column(name="ELIG_ADSL", type="integer", nullable=false)
     */
    private $eligAdsl;

    /**
     * @var string
     * @ORM\Column(name="TYPE_CLIENT", type="string", columnDefinition="ENUM('F', 'MOG', 'MOV')", nullable=false)
     */
    private $typeClient;

    /**
     * @return integer
     */
    public function getIdClient() {
        return $this->idClient;
    }

    /**
     * @return integer
     */
    public function getEligFttla() {
        return $this->eligFttla;
    }

    /**
     * @return integer
     */
    public function getEligAdsl() {
        return $this->eligAdsl;
    }

    /**
     * @return string
     */
    public function getTypeClient() {
        return $this->typeClient;
    }

    /**
     * @param integer $idClient
     */
    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    /**
     * @param integer $eligFttla
     */
    public function setEligFttla($eligFttla) {
        $this->eligFttla = $eligFttla;
    }

    /**
     * @param integer $eligAdsl
     */
    public function setEligAdsl($eligAdsl) {
        $this->eligAdsl = $eligAdsl;
    }

    /**
     * @param string $typeClient
     */
    public function setTypeClient($typeClient) {
        $this->typeClient = $typeClient;
    }

}
