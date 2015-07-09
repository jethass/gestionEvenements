<?php
namespace Omea\GestionTelco\PortabilityBundle\External\Provisioning\Types;

class ProvisioningResiliationRequest
{
    /** the phone number to be cut off
     * @var string
     */
    public $msisdn;

    /** Whether there's portability in this resiliation
     * @var boolean
     */
    public $portabilityFlag = false;

    /** the unique identifier for the portability
     * @var int
     */
    public $idPortage = null;

    public function __toString()
    {
        return print_r($this, true);
    }
}
