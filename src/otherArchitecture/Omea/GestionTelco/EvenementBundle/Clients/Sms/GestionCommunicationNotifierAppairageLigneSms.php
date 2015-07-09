<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationNotifierAppairageLigneSms
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierAppairageLigneSms
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

}
