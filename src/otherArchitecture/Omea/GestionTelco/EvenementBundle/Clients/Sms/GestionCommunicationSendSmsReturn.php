<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationSendSmsReturn
{

    /**
     * @var int $codeRetour
     */
    protected $codeRetour = null;

    /**
     * @var string $labelRetour
     */
    protected $labelRetour = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return int
     */
    public function getCodeRetour()
    {
      return $this->codeRetour;
    }

    /**
     * @param int $codeRetour
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationSendSmsReturn
     */
    public function setCodeRetour($codeRetour)
    {
      $this->codeRetour = $codeRetour;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabelRetour()
    {
      return $this->labelRetour;
    }

    /**
     * @param string $labelRetour
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationSendSmsReturn
     */
    public function setLabelRetour($labelRetour)
    {
      $this->labelRetour = $labelRetour;
      return $this;
    }

}
