<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Bridage;

class GestionClientOptionAddOption
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

    /**
     * @var int $idActivite
     */
    protected $idActivite = null;

    /**
     * @var int $idConseiller
     */
    protected $idConseiller = null;

    /**
     * @var boolean $jusquaRaz
     */
    protected $jusquaRaz = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionAddOption
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionAddOption
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionAddOption
     */
    public function setIdOptionGroup($idOptionGroup)
    {
      $this->idOptionGroup = $idOptionGroup;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdActivite()
    {
      return $this->idActivite;
    }

    /**
     * @param int $idActivite
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionAddOption
     */
    public function setIdActivite($idActivite)
    {
      $this->idActivite = $idActivite;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdConseiller()
    {
      return $this->idConseiller;
    }

    /**
     * @param int $idConseiller
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionAddOption
     */
    public function setIdConseiller($idConseiller)
    {
      $this->idConseiller = $idConseiller;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getJusquaRaz()
    {
      return $this->jusquaRaz;
    }

    /**
     * @param boolean $jusquaRaz
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionAddOption
     */
    public function setJusquaRaz($jusquaRaz)
    {
      $this->jusquaRaz = $jusquaRaz;
      return $this;
    }

}
