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

    /**
     * @param FemtoProvisioningMonitoring $fpm
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdn
     */
    protected function getFemtoMsisdn(FemtoProvisioningMonitoring $fpm)
    {
        // Get the related FemtoActiveClient
        $fac = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClient')
            ->findOneBy(
                array(
                    'numAbo' => $fpm->getNumAbo(),
                    'state' => $this->em
                        ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                        ->find(FemtoActiveClientState::ACTIF)
                )
            );

        // Get the FemtoMsisdn
        $fm = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
            ->findOneBy(
                array(
                    'msisdn' => $fpm->getMsisdn(),
                    'fac'    => $fac,
                    'state'  => $this->em
                        ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                        ->find(FemtoMsisdnState::RETRAIT_EN_COURS)
                )
            );

        return $fm;
    }

    /**
     * @param FemtoProvisioningMonitoring $fpm
     */
    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fm = $this->getFemtoMsisdn($fpm);

        if (null !== $fm) {
            $fm->setDateFin(new \DateTime());
            $fm->setState(
                $this->em
                    ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                    ->find(FemtoMsisdnState::RETIRE)
            );
        }

        $this->em->flush();
    }

    /**
     * @param FemtoProvisioningMonitoring $fpm
     */
    public function callbackOnFailure(FemtoProvisioningMonitoring $fpm)
    {
        $fm = $this->getFemtoMsisdn($fpm);

        if (null !== $fm) {
            $fm->setState(
                $this->em
                    ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                    ->find(FemtoMsisdnState::EN_ERREUR)
            );
        }
        
        $this->em->flush();
    }
}
