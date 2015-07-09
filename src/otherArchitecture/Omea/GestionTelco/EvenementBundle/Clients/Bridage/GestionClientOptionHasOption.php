<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Bridage;

class GestionClientOptionHasOption
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var string $idOption
     */
    protected $idOption = null;

    /**
     * @var string $idOptionGroup
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionHasOption
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return string
     */
    public function getIdOption()
    {
      return $this->idOption;
    }

    /**
     * @param string $idOption
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionHasOption
     */
    public function setIdOption($idOption)
    {
      $this->idOption = $idOption;
      return $this;
    }

    /**
     * @return string
     */
    public function getIdOptionGroup()
    {
      return $this->idOptionGroup;
    }

    /**
     * @param string $idOptionGroup
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionHasOption
     */
    public function setIdOptionGroup($idOptionGroup)
    {
      $this->idOptionGroup = $idOptionGroup;
      return $this;
    }

}
