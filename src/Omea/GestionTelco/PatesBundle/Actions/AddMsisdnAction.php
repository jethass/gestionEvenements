<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;
use Omea\GestionTelco\PatesBundle\Exception\NotFoundException;

class AddMsisdnAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $fac = $this->getActiveClients($fpm->getNumAbo(), FemtoActiveClientState::ACTIF);
        // Check that the client is active
        if (empty($fac)) {
            return false;
        }

        $imsi = $this->getImsiByMsisdn($fpm->getMsisdn());

        $request = array(
            'ACLId'         => 'VM'.$fpm->getNumAbo(),
            'MSISDN'        => $fpm->getMsisdn(),
            'IMSI'          => $imsi
        );

        return $request;
    }

    /**
     * @param FemtoProvisioningMonitoring $fpm
     * @return \Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdn
     */
    protected function getFemtoMsisdn(FemtoProvisioningMonitoring $fpm)
    {
        $fm = null;
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());

        if (isset($fpmArgs['imsi']) && !empty($fpmArgs['imsi'])) {
            $fm = $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
                ->findOneBy(array('msisdn' => $fpm->getMsisdn(), 'imsi' => $fpmArgs['imsi']));
        } else {
            $fm = $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
                ->findOneBy(array('msisdn' => $fpm->getMsisdn()));
        }
        return $fm;
    }
    
    /**
     * @param FemtoProvisioningMonitoring $fpm
     */
    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fm = $this->getFemtoMsisdn($fpm);
        $fm->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                ->find(FemtoMsisdnState::ACTIF)
        );

        $this->em->flush();
    }
    
    /**
     * @param FemtoProvisioningMonitoring $fpm
     */
    public function callbackOnFailure(FemtoProvisioningMonitoring $fpm)
    {
        $fm = $this->getFemtoMsisdn($fpm);
        
        $fm->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                ->find(FemtoMsisdnState::EN_ERREUR)
        );

        $this->em->flush();
    }
}
