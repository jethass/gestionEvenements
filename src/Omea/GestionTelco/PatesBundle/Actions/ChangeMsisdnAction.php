<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;

class ChangeMsisdnAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());

        $request = array(
            'ACLId'              => 'VM'.$fpm->getNumAbo(),
            'userMSISDN'         => $fpm->getMsisdn(),
            'newMSISDN'          => $fpmArgs['newMsisdn']
        );

        return $request;
    }

    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());

        $fm = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
            ->findOneBy(array('msisdn' => $fpm->getMsisdn()));

        $fm->setMsisdn($fpmArgs['newMsisdn']);

        $this->em->flush();
    }
}
