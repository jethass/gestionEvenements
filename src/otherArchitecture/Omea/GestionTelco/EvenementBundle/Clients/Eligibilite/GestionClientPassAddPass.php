<?php

namespace Omea\GestionTelco\EvenementBundle\Clients\Eligibilite;

class GestionClientPassAddPass
{

    /**
     * @var int $idClient
     */
    protected $idClient = null;

    /**
     * @var int $idOption
     */
    protected $idOption = null;

    /**
     * @var int $idOptionGroup
     */
    protected $idOptionGroup = null;

    /**
     * @var int $idActivite
     */
    protected $idActivite = null;

    /**
     * @var int $idConseiller
     */
    protected $idConseiller = null;

    /**
     * @var string $commentaire
     */
    protected $commentaire = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return int
     */
    public function getIdClient()
    {
      return $this->idClient;
    }

    /**
     * @param int $idClient
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassAddPass
     */
    public function setIdClient($idClient)
    {
      $this->idClient = $idClient;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdOption()
    {
      return $this->idOption;
    }

    /**
     * @param int $idOption
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassAddPass
     */
    public function setIdOption($idOption)
    {
      $this->idOption = $idOption;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdOptionGroup()
    {
      return $this->idOptionGroup;
    }

    /**
     * @param int $idOptionGroup
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassAddPass
     */
    public function setIdOptionGroup($idOptionGroup)
    {
      $this->idOptionGroup = $idOptionGroup;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdActivite()
    {
      return $this->idActivite;
    }

    /**
     * @param int $idActivite
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassAddPass
     */
    public function setIdActivite($idActivite)
    {
      $this->idActivite = $idActivite;
      return $this;
    }

    /**
     * @return int
     */
    public function getIdConseiller()
    {
      return $this->idConseiller;
    }

    /**
     * @param int $idConseiller
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassAddPass
     */
    public function setIdConseiller($idConseiller)
    {
      $this->idConseiller = $idConseiller;
      return $this;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
      return $this->commentaire;
    }

    /**
     * @param string $commentaire
     * @return \Omea\GestionTelco\EvenementBundle\Clients\Eligibilite\GestionClientPassAddPass
     */
    public function setCommentaire($commentaire)
    {
      $this->commentaire = $commentaire;
      return $this;
    }

}
