<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Historique;

class PoseHistoReturn
{

    /**
     * @var int $codeRetour
     */
    protected $codeRetour = null;

    /**
     * @var string $libelle
     */
    protected $libelle = null;

    /**
     * @var string $idHisto
     */
    protected $idHisto = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoReturn
     */
    public function setCodeRetour($codeRetour)
    {
      $this->codeRetour = $codeRetour;
      return $this;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
      return $this->libelle;
    }

    /**
     * @param string $libelle
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoReturn
     */
    public function setLibelle($libelle)
    {
      $this->libelle = $libelle;
      return $this;
    }

    /**
     * @return string
     */
    public function getIdHisto()
    {
      return $this->idHisto;
    }

    /**
     * @param string $idHisto
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Historique\PoseHistoReturn
     */
    public function setIdHisto($idHisto)
    {
      $this->idHisto = $idHisto;
      return $this;
    }

}
