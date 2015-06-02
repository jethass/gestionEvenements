<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;

interface ActionInterface
{
    /**
     * Generate the request used to call the ws
     *
     * @param FemtoProvisioningMonitoring $fpm
     * @return array
     */
    public function generateRequest(FemtoProvisioningMonitoring $fpm);

    /**
     * Take care of the ws callback
     *
     * @param FemtoProvisioningMonitoring $fpm
     * @return mixed
     */
    public function callback(FemtoProvisioningMonitoring $fpm);
    
    /**
     * Called when shit happens
     *
     * @param FemtoProvisioningMonitoring $fpm
     * @return mixed
     */
    public function callbackOnFailure(FemtoProvisioningMonitoring $fpm);
}
