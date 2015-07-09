<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationNotifierRelanceMaterielSms
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var string $dateRestitution
     */
    protected $dateRestitution = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRelanceMaterielSms
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return string
     */
    public function getDateRestitution()
    {
      return $this->dateRestitution;
    }

    /**
     * @param string $dateRestitution
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRelanceMaterielSms
     */
    public function setDateRestitution($dateRestitution)
    {
      $this->dateRestitution = $dateRestitution;
      return $this;
    }

}
