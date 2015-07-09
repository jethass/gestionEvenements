<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationConsultSms
{

    /**
     * @var string $msisdn
     */
    protected $msisdn = null;

    /**
     * @var int $idSmsSent
     */
    protected $idSmsSent = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationConsultSms
     */
    public function setMsisdn($msisdn)
    {
      $this->msisdn = $msisdn;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdSmsSent()
    {
      return $this->idSmsSent;
    }

    /**
     * @param int $idSmsSent
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationConsultSms
     */
    public function setIdSmsSent($idSmsSent)
    {
      $this->idSmsSent = $idSmsSent;
      return $this;
    }

}
