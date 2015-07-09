<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationSendSms
{

    /**
     * @var string $msisdn
     */
    protected $msisdn = null;

    /**
     * @var string $numeroAppelant
     */
    protected $numeroAppelant = null;

    /**
     * @var string $texteSms
     */
    protected $texteSms = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getMsisdn()
    {
      return $this->msisdn;
    }

    /**
     * @param string $msisdn
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationSendSms
     */
    public function setMsisdn($msisdn)
    {
      $this->msisdn = $msisdn;
      return $this;
    }

    /**
     * @return string
     */
    public function getNumeroAppelant()
    {
      return $this->numeroAppelant;
    }

    /**
     * @param string $numeroAppelant
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationSendSms
     */
    public function setNumeroAppelant($numeroAppelant)
    {
      $this->numeroAppelant = $numeroAppelant;
      return $this;
    }

    /**
     * @return string
     */
    public function getTexteSms()
    {
      return $this->texteSms;
    }

    /**
     * @param string $texteSms
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationSendSms
     */
    public function setTexteSms($texteSms)
    {
      $this->texteSms = $texteSms;
      return $this;
    }

}
