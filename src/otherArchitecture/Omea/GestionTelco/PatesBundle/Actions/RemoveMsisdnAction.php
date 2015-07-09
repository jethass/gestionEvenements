<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;

class RemoveMsisdnAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $fac = $this->getActiveClients($fpm->getNumAbo(), FemtoActiveClientState::ACTIF);
        // Check that the client is activate
        if (empty($fac)) {
            return false;
        }

        $request = array(
            'ACLId'         => 'VM'.$fpm->getNumAbo(),
            'MSISDN'        => $fpm->getMsisdn(),
        );

        return $request;
    }

    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fm = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
            ->findOneBy(array('msisdn' => $fpm->getMsisdn()));

        $fm->setDateFin(new \DateTime());

        $fm->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                ->find(FemtoMsisdnState::RETIRE)
        );

        $this->em->flush();
    }
    
    public function callbackOnFailure(FemtoProvisioningMonitoring $fpm)
    {
        $fm = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
            ->findOneBy(array('msisdn' => $fpm->getMsisdn()));
        
        $fm->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                ->find(FemtoMsisdnState::ACTIF)
        );
        
        $this->em->flush();
    }
}
