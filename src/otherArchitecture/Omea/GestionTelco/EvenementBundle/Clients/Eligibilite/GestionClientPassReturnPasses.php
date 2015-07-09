<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Eligibilite;

class GestionClientPassReturnPasses
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
     * @var ArrayCustom $passes
     */
    protected $passes = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturnPasses
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturnPasses
     */
    public function setLabelRetour($labelRetour)
    {
      $this->labelRetour = $labelRetour;
      return $this;
    }

    /**
     * @return ArrayCustom
     */
    public function getPasses()
    {
      return $this->passes;
    }

    /**
     * @param ArrayCustom $passes
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturnPasses
     */
    public function setPasses($passes)
    {
      $this->passes = $passes;
      return $this;
    }

}
