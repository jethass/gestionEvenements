<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\SfrPnm;

interface SfrPnmServiceInterface
{
    public function checkAvailability($msisdn, $rio, \DateTime $datePortage, $opr, $opd);

    public function reservePortability($msisdn, $rio, \DateTime $datePortage, $tranche, $opr);

    public function cancelPortability($msisdn, $rio, \DateTime $datePortage, $tranche, $codeAnnulation, $opr);
}
