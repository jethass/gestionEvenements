<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;
use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoringStep;

class CommandeAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        return array();
    }

    public function updateTransaction(FemtoProvisioningMonitoring $fpm)
    {
        $response = new \stdClass();
        $response->reasonCode = '0';
        $response->message = '';

        $arguments = $this->transformComplementToArray($fpm->getComplement());
        $transaction = $this->emMain->getRepository('Omea\Entity\Main\Transaction')->find($arguments['transId']);

        if (empty($transaction)) {
            $response->reasonCode = 'InvalidArgs';
            $response->message = 'The transaction '.$arguments['transId'].' does not exists';
            return $response;
        }

        // Check that NOW is > to date_demande + 24h
        $dateOrder = $fpm->getDateDemande();
        $dateOrder->modify('+1 day');

        if (new \DateTime() > $dateOrder) {
            $transaction->setTransTraite(new \DateTime());
            $this->emMain->flush();
        } else {
            // If the response is null, we create a non-blocking error (cf config error_code_to_skip)
            $response->reasonCode = 'VM002';
            $response->message = 'The transaction '.$arguments['transId'].' is not ready';
        }

        return $response;
    }

    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fpm->setStep(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoProvisioningMonitoringStep')
                ->find(FemtoProvisioningMonitoringStep::END)
        );
        $fpm->setCodeRetour(0);
        $fpm->setDateTraitement(new \DateTime());

        $this->em->flush();
    }
}
