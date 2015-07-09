<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;

class ResiliationAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $request = array(
            'ACLId'         => 'VM'.$fpm->getNumAbo(),
        );

        return $request;
    }

    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fac = $this->getActiveClients($fpm->getNumAbo(), FemtoActiveClientState::EN_RESILIATION);
        $fac = $fac[0];

        $fac->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                ->find(FemtoActiveClientState::RESILIE)
        );

        $msisdnState = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
            ->find(FemtoMsisdnState::RETIRE);

        foreach ($fac->getMsisdns() as $msisdn) {
            $msisdn->setDateFin(new \DateTime());
            $msisdn->setState($msisdnState);
        }

        $this->em->flush();
    }
}
