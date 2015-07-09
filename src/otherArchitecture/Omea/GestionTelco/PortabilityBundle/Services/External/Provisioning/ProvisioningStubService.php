<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning;

use Omea\GestionTelco\PortabilityBundle\Services\External\GenericStubService;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningActivationRequest;
use Omea\GestionTelco\PortabilityBundle\Services\External\Provisioning\Types\ProvisioningResiliationRequest;

class ProvisioningStubService extends GenericStubService implements ProvisioningServiceInterface
{
    /** Sends a request to activate a mobile phone line
     * @param  ProvisioningActivationRequest $request
     * @return mixed
     */
    public function activate(ProvisioningActivationRequest $request)
    {
        $this->logger->info("Activation Request : $request");

        return 'Yay!';
    }

    /** Sends a request to resiliate a mobile phone line
     * @param  ProvisioningResiliationRequest $request
     * @return mixed
     */
    public function resiliate(ProvisioningResiliationRequest $request)
    {
        $this->logger->info("Resiliation Request : $request");

        return 'Yay!';
    }
}
