<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Bridage;

class GestionClientOptionReturn
{

    /**
     * @var int $codeRetour
     */
    protected $codeRetour = null;

    /**
     * @var string $labelRetour
     */
    protected $labelRetour = null;

    /**
     * @var string $dateFin
     */
    protected $dateFin = null;

    /**
     * @var string $labelOption
     */
    protected $labelOption = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionReturn
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionReturn
     */
    public function setLabelRetour($labelRetour)
    {
      $this->labelRetour = $labelRetour;
      return $this;
    }

    /**
     * @return string
     */
    public function getDateFin()
    {
      return $this->dateFin;
    }

    /**
     * @param string $dateFin
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionReturn
     */
    public function setDateFin($dateFin)
    {
      $this->dateFin = $dateFin;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabelOption()
    {
      return $this->labelOption;
    }

    /**
     * @param string $labelOption
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionReturn
     */
    public function setLabelOption($labelOption)
    {
      $this->labelOption = $labelOption;
      return $this;
    }

}
