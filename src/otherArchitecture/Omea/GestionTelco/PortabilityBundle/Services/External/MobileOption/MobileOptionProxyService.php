<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\MobileOption;

use Omea\GestionTelco\PortabilityBundle\Services\External\GenericProxyService;

class MobileOptionProxyService extends GenericProxyService implements MobileOptionServiceInterface
{
    /**
     * @param int $idClient
     */
    public function getDetailsClient($idClient)
    {
        $request = array('idClient' => $idClient);
        $this->setLegacyMethod('getDetailsByClient');

        $result = $this->soapClient->send(array($request));

        return $result;
    }
}
