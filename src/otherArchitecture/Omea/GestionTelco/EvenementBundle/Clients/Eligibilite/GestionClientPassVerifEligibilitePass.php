<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Eligibilite;

class GestionClientPassVerifEligibilitePass
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var int $idOption
     */
    protected $idOption = null;

    /**
     * @var int $idOptionGroup
     */
    protected $idOptionGroup = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getIdClient()
    {
      return $this->idClient;
    }

    /**
     * @param string $idClient
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassVerifEligibilitePass
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdOption()
    {
      return $this->idOption;
    }

    /**
     * @param int $idOption
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassVerifEligibilitePass
     */
    public function setIdOption($idOption)
    {
      $this->idOption = $idOption;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdOptionGroup()
    {
      return $this->idOptionGroup;
    }

    /**
     * @param int $idOptionGroup
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassVerifEligibilitePass
     */
    public function setIdOptionGroup($idOptionGroup)
    {
      $this->idOptionGroup = $idOptionGroup;
      return $this;
    }

}
