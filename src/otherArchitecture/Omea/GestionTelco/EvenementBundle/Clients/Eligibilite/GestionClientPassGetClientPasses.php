<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Eligibilite;

class GestionClientPassGetClientPasses
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassGetClientPasses
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

}
