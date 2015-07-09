<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Sms;

class GestionCommunicationNotifierRelanceOptionSms
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var int $periode
     */
    protected $periode = null;

    /**
     * @var string $parcours
     */
    protected $parcours = null;

    /**
     * @param int $periode
     */
    public function __construct($periode)
    {
      $this->periode = $periode;
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRelanceOptionSms
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return int
     */
    public function getPeriode()
    {
      return $this->periode;
    }

    /**
     * @param int $periode
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRelanceOptionSms
     */
    public function setPeriode($periode)
    {
      $this->periode = $periode;
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Sms\GestionCommunicationNotifierRelanceOptionSms
     */
    public function setParcours($parcours)
    {
      $this->parcours = $parcours;
      return $this;
    }

}
