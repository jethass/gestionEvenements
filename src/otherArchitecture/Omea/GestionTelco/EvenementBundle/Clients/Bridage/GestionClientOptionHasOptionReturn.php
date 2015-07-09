<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Bridage;

class GestionClientOptionHasOptionReturn
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
     * @var boolean $hasOption
     */
    protected $hasOption = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionHasOptionReturn
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionHasOptionReturn
     */
    public function setLabelRetour($labelRetour)
    {
      $this->labelRetour = $labelRetour;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getHasOption()
    {
      return $this->hasOption;
    }

    /**
     * @param boolean $hasOption
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Bridage\GestionClientOptionHasOptionReturn
     */
    public function setHasOption($hasOption)
    {
      $this->hasOption = $hasOption;
      return $this;
    }

}
