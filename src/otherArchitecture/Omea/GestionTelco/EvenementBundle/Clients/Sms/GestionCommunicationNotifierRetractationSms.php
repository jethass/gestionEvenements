<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationNotifierRetractationSms
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var string $parcours
     */
    protected $parcours = null;

    /**
     * @var int $active
     */
    protected $active = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRetractationSms
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return string
     */
    public function getParcours()
    {
      return $this->parcours;
    }

    /**
     * @param string $parcours
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRetractationSms
     */
    public function setParcours($parcours)
    {
      $this->parcours = $parcours;
      return $this;
    }

    /**
     * @return int
     */
    public function getActive()
    {
      return $this->active;
    }

    /**
     * @param int $active
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRetractationSms
     */
    public function setActive($active)
    {
      $this->active = $active;
      return $this;
    }

}
