<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="ELIGIBILITE_INTERNET")
 * @ORM\Entity
 */
class EligibiliteInternet
{
    /**
     * @var integer $idEligibiliteInternet
     *
     * @ORM\Column(name="ID_ELIGIBILITE_INTERNET", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idEligibiliteInternet;

    /**
     *
     * @var integer $idClient
     * @ORM\Column(name="ID_CLIENT", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var string $adsl
     * @ORM\Column(name="ADSL", type="string", length=10)
     */
    private $adsl;

    /**
     * @var date $cable
     * @ORM\Column(name="CABLE", type="boolean")
     */
    private $cable;

    /**
     * @var string $fibre
     * @ORM\Column(name="FIBRE", type="boolean")
     */
    private $fibre;

    /**
     * @var dateTime $dateCreated
     * @ORM\Column(name="DATE_CREATED", type="datetime")
     */

    private $dateCreated;

    /**
     * @return the $idEligibiliteInternet
     */
    public function getIdEligibiliteInternet() {
        return $this->idEligibiliteInternet;
    }

    /**
     * @param number $idEligibiliteInternet
     */
    public function setIdEligibiliteInternet($idEligibiliteInternet) {
        $this->idEligibiliteInternet = $idEligibiliteInternet;
    }

    /**
     * @return integer $idClient
     */
    public function getIdClient() {
        return $this->idClient;
    }

    /**
     * @param integer $idClient
     */
    public function setIdClient($idClient) {
        $this->idClient = $idClient;
    }

    /**
     * @return string $adsl
     */
    public function getAdsl() {
        return $this->adsl;
    }

    /**
     * @param string $adsl
     */
    public function setAdsl($adsl) {
        $this->adsl = $adsl;
    }

    /**
     * @return boolean $cable
     */
    public function getCable() {
        return $this->cable;
    }

    /**
     * @param boolean $cable
     */
    public function setCable($cable) {
        $this->cable = $cable;
    }

    /**
     * @return boolean $fibre
     */
    public function getFibre() {
        return $this->fibre;
    }

    /**
     * @param boolean $fibre
     */
    public function setFibre($fibre) {
        $this->fibre = $fibre;
    }

    /**
     * @return dateTime $dateCreated
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param dateTime $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated) {
        $this->dateCreated = $dateCreated;
    }


}
