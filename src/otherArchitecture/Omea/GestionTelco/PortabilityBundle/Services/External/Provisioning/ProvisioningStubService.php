<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning;

use Omea\GestionTelco\PortabilityBundle\Services\External\GenericStubService;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningActivationRequest;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningResiliationRequest;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningActivationResponse;

class ProvisioningStubService extends GenericStubService implements ProvisioningServiceInterface
{
    /** Sends a request to activate a mobile phone line
     * @param  ProvisioningActivationRequest  $request
     * @return ProvisioningActivationResponse
     */
    public function activate(ProvisioningActivationRequest $request)
    {
        $this->logger->info("Activation Request : $request");

        $response = new ProvisioningActivationResponse();
        $response->numAbo = mt_rand(10000000, 19999999);
        
        return $response;
    }

    /** Sends a request to resiliate a mobile phone line
     * @param  ProvisioningResiliationRequest $request
     * @return mixed
     */
    public function resiliate(ProvisioningResiliationRequest $request)
    {
        $this->logger->info("Resiliation Request : $request");

        return true;
    }
}
