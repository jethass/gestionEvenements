<?php
namespace Omea\GestionTelco\PortabilityBundle\External\Provisioning\Types;

class ProvisioningActivationRequest
{
    /** The serial number for the SIM card to be activated
     * @var string
     */
    public $iccid;

    /** Whether there's portability in this activation
     * @var boolean
     */
    public $portabilityFlag = false;

    /** the phone number to be ported
     * @var string
     */
    public $msisdn = null;

    /** the unique identifier for the portability
     * @var int
     */
    public $idPortage = null;

    public function __toString()
    {
        return print_r($this, true);
    }
}
