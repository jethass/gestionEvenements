<?php

namespace Omea\Entity\Main;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="RC_CRITERE")
 */
class RcCritere {

    const ELIGIBLE = 'ELIGIBLE';
    const NON_ELIGIBLE = 'NON_ELIGIBLE';
    const NA = 'NA';
    const OUI = 'OUI';
    const NON = 'NON';

    /**
     * @var string
     * @ORM\Column(name="ADSL", type="string", columnDefinition="ENUM('ELIGIBLE', 'NON_ELIGIBLE', 'NA')", nullable=false)
     * @ORM\Id
     */
    private $adsl;

    /**
     * @var string
     * @ORM\Column(name="FIBRE", type="string", columnDefinition="ENUM('ELIGIBLE', 'NON_ELIGIBLE', 'NA')", nullable=false)
     * @ORM\Id
     */
    private $fibre;

    /**
     * @var string
     * @ORM\Column(name="CLIENT_VM_SFR", type="string", columnDefinition="ENUM('OUI', 'NON')", nullable=false)
     * @ORM\Id
     */
    private $clientVmSfr;

    /**
     * @ORM\ManyToOne(targetEntity="RcProposition")
     * @ORM\JoinColumn(name="ID_RCP", referencedColumnName="ID_RCP", nullable=false)
     */
    private $proposition;

    /**
     * Constructor
     * 
     * Sets default values
     */
    public function __construct() {
        $this->setAdsl(RcCritere::NA);
        $this->setFibre(RcCritere::NA);
        $this->setClientVmSfr(RcCritere::NON);
    }

    /**
     * @return string
     */
    public function getAdsl() {
        return $this->adsl;
    }

    /**
     * @return string
     */
    public function getFibre() {
        return $this->fibre;
    }

    /**
     * @return string
     */
    public function getClientVmSfr() {
        return $this->clientVmSfr;
    }

    /**
     * @return string
     */
    public function getProposition() {
        return $this->proposition;
    }

    /**
     * @param string $adsl
     */
    public function setAdsl($adsl) {
        $this->adsl = $adsl;
    }

    /**
     * @param string $fibre
     */
    public function setFibre($fibre) {
        $this->fibre = $fibre;
    }

    /**
     * @param string $clientVmSfr
     */
    public function setClientVmSfr($clientVmSfr) {
        $this->clientVmSfr = $clientVmSfr;
    }

    /**
     * @param string $proposition
     */
    public function setProposition($proposition) {
        $this->proposition = $proposition;
    }

}
