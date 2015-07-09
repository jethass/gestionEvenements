<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationNotifierEvenementSms
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var string $codeTemplate
     */
    protected $codeTemplate = null;

    /**
     * @var string $idOption
     */
    protected $idOption = null;

    /**
     * @var string $idEvent
     */
    protected $idEvent = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierEvenementSms
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return string
     */
    public function getCodeTemplate()
    {
      return $this->codeTemplate;
    }

    /**
     * @param string $codeTemplate
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierEvenementSms
     */
    public function setCodeTemplate($codeTemplate)
    {
      $this->codeTemplate = $codeTemplate;
      return $this;
    }

    /**
     * @return string
     */
    public function getIdOption()
    {
      return $this->idOption;
    }

    /**
     * @param string $idOption
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierEvenementSms
     */
    public function setIdOption($idOption)
    {
      $this->idOption = $idOption;
      return $this;
    }

    /**
     * @return string
     */
    public function getIdEvent()
    {
      return $this->idEvent;
    }

    /**
     * @param string $idEvent
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierEvenementSms
     */
    public function setIdEvent($idEvent)
    {
      $this->idEvent = $idEvent;
      return $this;
    }

}
