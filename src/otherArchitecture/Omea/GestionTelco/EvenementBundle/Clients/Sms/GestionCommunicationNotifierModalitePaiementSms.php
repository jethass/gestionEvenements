<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationNotifierModalitePaiementSms
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var string $step
     */
    protected $step = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierModalitePaiementSms
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return string
     */
    public function getStep()
    {
      return $this->step;
    }

    /**
     * @param string $step
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierModalitePaiementSms
     */
    public function setStep($step)
    {
      $this->step = $step;
      return $this;
    }

}
