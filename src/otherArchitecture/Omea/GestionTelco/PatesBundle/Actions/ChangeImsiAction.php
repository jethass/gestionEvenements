<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;

class ChangeImsiAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());

        $request = array(
            'ACLId'              => 'VM'.$fpm->getNumAbo(),
            'userMSISDN'         => $fpm->getMsisdn(),
            'newIMSI'            => $fpmArgs['newImsi']
        );

        return $request;
    }

    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());

        $fm = $this->em
            ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdn')
            ->findOneBy(array('msisdn' => $fpm->getMsisdn()));

        $fm->setImsi($fpmArgs['newImsi']);

        $this->em->flush();
    }
}
