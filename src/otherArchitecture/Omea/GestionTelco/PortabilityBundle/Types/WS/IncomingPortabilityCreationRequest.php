<?php
namespace Omea\GestionTelco\PortabilityBundle\Types\WS;

class IncomingPortabilityCreationRequest
{
    /** @var int */
    public $idClient;
    
    /** @var string */
    public $msisdn;
    
    /** @var string */
    public $rio;
    
    /** @var string */
    public $dateDemande;
    
    /** @var string */
    public $datePortage;
    
    /** @var int */
    public $tranche;
}
