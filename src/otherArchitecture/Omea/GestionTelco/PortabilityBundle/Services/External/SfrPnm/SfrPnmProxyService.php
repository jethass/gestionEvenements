<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\SfrPnm;

use Omea\GestionTelco\PortabilityBundle\Services\External\GenericProxyService;

class SfrPnmProxyService extends GenericProxyService implements SfrPnmServiceInterface
{
    public function checkAvailability($msisdn, $rio, \DateTime $datePortage, $opr, $opd)
    {
        $request = array('msisdn'      => $msisdn,
                         'rio'         => $rio,
                         'datePortage' => $datePortage->format('Ymd'),
                         'opr'         => $opr);
        
        $this->setMethod('PNMcheckAvailability');

        $result = $this->soapClient->send(array('params' => $request));
        
        $tranches = array();
        // SFR for some reason doesn't use the same tranche values as the EGP, so we need to convert
        $conversion = array_flip($this->config['tranches']['sfr_conversion']);
        foreach($result['tranches'] as $tranche) {
            if (array_key_exists($tranche['horaire'], $conversion)) {
                $tranches[] = $conversion[$tranche['horaire']];
        }

        return $tranches;
    }
    
    public function reservePortability($msisdn, $rio, \DateTime $datePortage, $tranche, $opr)
    {
        $request = array('msisdn'      => $msisdn,
                         'rio'         => $rio,
                         'datePortage' => $datePortage->format('Ymd'),
                         'tranche'     => $this->config['tranches']['sfr_conversion'][$tranche],
                         'opr'         => $opr);
        
        $this->setMethod('PNMreservePortability');

        $result = $this->soapClient->send(array('params' => $request));

        return ($result['returnCode'] == 0);
    }

    public function cancelPortability($msisdn, $rio, \DateTime $datePortage, $tranche, $codeAnnulation, $opr)
    {
        $request = array('msisdn'         => $msisdn,
                         'rio'            => $rio,
                         'datePortage'    => $datePortage->format('Ymd'),
                         'tranche'        => $this->config['tranches']['sfr_conversion'][$tranche],
                         'codeAnnulation' => $codeAnnulation,
                         'opr'            => $opr);
        
        $this->setMethod('PNMcancelPortability');

        $result = $this->soapClient->send(array('params' => $request));

        return ($result['returnCode'] == 0);
    }
}
