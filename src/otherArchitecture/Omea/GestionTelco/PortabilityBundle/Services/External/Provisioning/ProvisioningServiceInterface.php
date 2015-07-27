<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning;

use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningActivationRequest;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningResiliationRequest;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningActivationResponse;

interface ProvisioningServiceInterface
{
    /** Sends a request to activate a mobile phone line
     * @param  ProvisioningActivationRequest  $request
     * @return ProvisioningActivationResponse
     */
    public function activate(ProvisioningActivationRequest $request);

    /** Sends a request to resiliate a mobile phone line
     * @param  ProvisioningResiliationRequest $request
     * @return mixed
     */
    public function resiliate(ProvisioningResiliationRequest $request);
}
