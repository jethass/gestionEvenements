<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationConsultSmsReturn
{

    /**
     * @var string $id
     */
    protected $id = null;

    /**
     * @var string $msisdn
     */
    protected $msisdn = null;

    /**
     * @var string $sender
     */
    protected $sender = null;

    /**
     * @var string $message
     */
    protected $message = null;

    /**
     * @var string $sentOn
     */
    protected $sentOn = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getId()
    {
      return $this->id;
    }

    /**
     * @param string $id
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationConsultSmsReturn
     */
    public function setId($id)
    {
      $this->id = $id;
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationConsultSmsReturn
     */
    public function setMsisdn($msisdn)
    {
      $this->msisdn = $msisdn;
      return $this;
    }

    /**
     * @return string
     */
    public function getSender()
    {
      return $this->sender;
    }

    /**
     * @param string $sender
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationConsultSmsReturn
     */
    public function setSender($sender)
    {
      $this->sender = $sender;
      return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
      return $this->message;
    }

    /**
     * @param string $message
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationConsultSmsReturn
     */
    public function setMessage($message)
    {
      $this->message = $message;
      return $this;
    }

    /**
     * @return string
     */
    public function getSentOn()
    {
      return $this->sentOn;
    }

    /**
     * @param string $sentOn
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationConsultSmsReturn
     */
    public function setSentOn($sentOn)
    {
      $this->sentOn = $sentOn;
      return $this;
    }

}
