<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Historique;

class PoseHistoData
{

    /**
     * @var string $idClient
     */
    protected $idClient = null;

    /**
     * @var string $idEvent
     */
    protected $idEvent = null;

    /**
     * @var string $commMan
     */
    protected $commMan = null;

    /**
     * @var string $priorite
     */
    protected $priorite = null;

    /**
     * @var string $idConseiller
     */
    protected $idConseiller = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoData
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoData
     */
    public function setIdEvent($idEvent)
    {
      $this->idEvent = $idEvent;
      return $this;
    }

    /**
     * @return string
     */
    public function getCommMan()
    {
      return $this->commMan;
    }

    /**
     * @param string $commMan
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoData
     */
    public function setCommMan($commMan)
    {
      $this->commMan = $commMan;
      return $this;
    }

    /**
     * @return string
     */
    public function getPriorite()
    {
      return $this->priorite;
    }

    /**
     * @param string $priorite
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoData
     */
    public function setPriorite($priorite)
    {
      $this->priorite = $priorite;
      return $this;
    }

    /**
     * @return string
     */
    public function getIdConseiller()
    {
      return $this->idConseiller;
    }

    /**
     * @param string $idConseiller
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoData
     */
    public function setIdConseiller($idConseiller)
    {
      $this->idConseiller = $idConseiller;
      return $this;
    }

}
