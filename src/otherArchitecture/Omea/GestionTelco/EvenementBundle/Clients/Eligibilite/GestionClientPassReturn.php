<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Eligibilite;

class GestionClientPassReturn
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
     * @var boolean $isEligibleOption
     */
    protected $isEligibleOption = null;

    /**
     * @var int $idSms
     */
    protected $idSms = null;

    /**
     * @var string $labelPass
     */
    protected $labelPass = null;

    
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturn
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturn
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
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturn
     */
    public function setDateFin($dateFin)
    {
      $this->dateFin = $dateFin;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getIsEligibleOption()
    {
      return $this->isEligibleOption;
    }

    /**
     * @param boolean $isEligibleOption
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturn
     */
    public function setIsEligibleOption($isEligibleOption)
    {
      $this->isEligibleOption = $isEligibleOption;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdSms()
    {
      return $this->idSms;
    }

    /**
     * @param int $idSms
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturn
     */
    public function setIdSms($idSms)
    {
      $this->idSms = $idSms;
      return $this;
    }

    /**
     * @return string
     */
    public function getLabelPass()
    {
      return $this->labelPass;
    }

    /**
     * @param string $labelPass
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassReturn
     */
    public function setLabelPass($labelPass)
    {
      $this->labelPass = $labelPass;
      return $this;
    }

}
