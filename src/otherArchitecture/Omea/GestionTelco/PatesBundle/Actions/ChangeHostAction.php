<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;

class ChangeHostAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());

        $request = array(
            'ACLId'         => 'VM'.$fpm->getNumAbo(),
            'HostMSISDN'    => $fpmArgs['newMsisdn']
        );

        return $request;
    }

    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        // Nothing to do...
    }
}
