<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\SfrPnm;

use Omea\GestionTelco\PortabilityBundle\Services\External\GenericStubService;

class SfrPnmStubService extends GenericStubService implements SfrPnmServiceInterface
{
    public function checkAvailability($msisdn, $rio, \DateTime $datePortage, $opr)
    {
        if (in_array($opd, $this->config['operators']['mvno'])) {
            // Intra-SFR portabilities have a specific tranche
            return '51';
        }
        // Let's simulate random SFR responses (including unavailability)
        $possibleResults = array(array(), array('11'), array('15'), array('11', '15'));
        $i = mt_rand(0, count($possibleResults) - 1);
        return $possibleResults[$i];
    }

    public function reservePortability($msisdn, $rio, \DateTime $datePortage, $tranche, $opr)
    {
        return true;
    }

    public function cancelPortability($msisdn, $rio, \DateTime $datePortage, $tranche, $codeAnnulation, $opr)
    {
        return true;
    }
}
