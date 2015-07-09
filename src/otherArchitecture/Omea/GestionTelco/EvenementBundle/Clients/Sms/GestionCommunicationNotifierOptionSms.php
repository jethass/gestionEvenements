<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationNotifierOptionSms
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierOptionSms
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierOptionSms
     */
    public function setIdOption($idOption)
    {
      $this->idOption = $idOption;
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierOptionSms
     */
    public function setStep($step)
    {
      $this->step = $step;
      return $this;
    }

}
