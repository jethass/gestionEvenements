<?php
namespace Omea\GestionTelco\PortabilityBundle\External\Provisioning\Types;

class ProvisioningActivationResponse
{
    /** An identifier for the created line
     * @var string
     */
    public $numAbo;

    public function __toString()
    {
        return print_r($this, true);
    }
}
