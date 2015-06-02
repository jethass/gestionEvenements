<?php
namespace Omea\GestionTelco\PatesBundle\Actions;

use Omea\GestionTelco\PatesBundle\Entity\FemtoProvisioningMonitoring;
use Omea\GestionTelco\PatesBundle\Entity\FemtoActiveClientState;

class ActivationAction extends AbstractAction implements ActionInterface
{
    public function generateRequest(FemtoProvisioningMonitoring $fpm)
    {
        $fpmArgs = $this->transformComplementToArray($fpm->getComplement());

        $femtoStock = $this->em->getRepository('OmeaGestionTelcoPatesBundle:FemtoStock')->find($fpmArgs['imei']);

        if (empty($femtoStock)) {
            throw new \Exception(sprintf('The femto_stock with imei: %s does not exists', $fpmArgs['imei']));
        }

        $stockMsisdn = $this->emMain->getRepository('Omea\Domain\Main\StockMsisdn')->find($fpm->getMsisdn());

        if (empty($stockMsisdn)) {
            throw new \Exception(sprintf('The stock_msisdn with msisdn: %s does not exists', $fpm->getMsisdn()));
        }

        $client = $this->emMain
            ->getRepository('Omea\Domain\Main\Client')
            ->find($stockMsisdn->getIdClient());

        if (empty($client)) {
            throw new \Exception(sprintf('The client with id: %s does not exists', $stockMsisdn->getIdClient()));
        }

        $localite = $this->emHexavia
            ->getRepository('Omea\Domain\Hexavia\Localite')
            ->fetchCity($client->getVille(), $client->getCodePos(), 1);

        if (empty($localite)) {
            throw new \Exception(
                sprintf(
                    'The localite with city: %s and zip code: %s does not exists',
                    $client->getVille(),
                    $client->getCodePos()
                )
            );
        }

        // Fix mantis #6601 add default behavior for the INSEECode
        $InseeCode = (!empty($localite[0]['codeInseeLocalite']) && null !== $localite[0]['codeInseeLocalite']) ? $localite[0]['codeInseeLocalite'] : '92044';

        $request = array(
            'ACLId'                 => 'VM'.$fpm->getNumAbo(),
            'HostMSISDN'            => $fpm->getMsisdn(),
            'FapHwIdSerial'         => $fpmArgs['imei'],
            'FapLatitude'           => $this->femtoConfig['fap_latitude'],
            'FapLongitude'          => $this->femtoConfig['fap_longitude'],
            'FapHwIdManufacturer'   => $femtoStock->getManufacturer(),
            'FapHwIdOUI'            => $femtoStock->getOui(),
            'FapHwIdProductClass'   => $femtoStock->getProductClass(),
            'INSEECode'             => $InseeCode
        );

        return $request;
    }

    public function callback(FemtoProvisioningMonitoring $fpm)
    {
        $fac = $this->getActiveClients($fpm->getNumAbo(), FemtoActiveClientState::EN_ATTENTE);
        $fac = $fac[0];

        $fac->setState(
            $this->em
                ->getRepository('OmeaGestionTelcoPatesBundle:FemtoActiveClientState')
                ->find(FemtoActiveClientState::ACTIF)
        );
        $fac->setActiveAt(new \DateTime());

        $this->em->flush();
    }
}
