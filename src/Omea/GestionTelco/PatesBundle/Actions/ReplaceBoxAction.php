<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoMsisdnState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;

class ReplaceBoxAction extends AbstractAction implements ActionInterface
{
    /**
     * @param FemtoProvisioningMonitoring $fpm
     * @return string|boolean
     */
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());
        if (!isset($fpmArgs['imei'])) {
            return false;
        }
        
        $femtoStock = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoStock')->findOneBy(array('imei' => $fpmArgs['imei']));
        
        if (null === $femtoStock) {
            return false;
        }
        
        $request = array(
            'ACLId' => 'VM' . $fpm->getNumAbo(),
            'ReplacementFapHwIdManufacturer' => $femtoStock->getManufacturer(),
            'ReplacementFapHwIdOUI' => $femtoStock->getOui(),
            'ReplacementFapHwIdProductClass' => $femtoStock->getProductClass(),
            'ReplacementFapHwIdSerial' => $femtoStock->getImei()
        );

        return $request;
    }

    /**
     * @param FemtoProvisioningMonitoring $fpm
     */
    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());
        
        $activeClients = $this->getActiveClients($fpm->getNumAbo(), FemtoActiveClientState::ACTIF);
        $activeClient = array_shift($activeClients);
        
        $activeClient->setImei(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoStock')
                ->find($fpmArgs['imei'])
        );
        
        $fpm->setStep(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringStep')
                ->find(\Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringStep::END)
        );
        
        $this->em->flush();
    }
    
    /**
     * @param FemtoProvisioningMonitoring $fpm
     */
    public function callbackOnFailure(FemtoProvisioningMonitoring $fpm)
    {
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
        $fm->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoMsisdnState')
                ->find(FemtoMsisdnState::EN_ERREUR)
        );

        $this->em->flush();
    }
}
