<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationResendSms
{

    /**
     * @var string $idSmsSent
     */
    protected $idSmsSent = null;

    /**
     * @var string $msisdn
     */
    protected $msisdn = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getIdSmsSent()
    {
      return $this->idSmsSent;
    }

    /**
     * @param string $idSmsSent
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationResendSms
     */
    public function setIdSmsSent($idSmsSent)
    {
      $this->idSmsSent = $idSmsSent;
      return $this;
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationResendSms
     */
    public function setMsisdn($msisdn)
    {
      $this->msisdn = $msisdn;
      return $this;
    }

}
