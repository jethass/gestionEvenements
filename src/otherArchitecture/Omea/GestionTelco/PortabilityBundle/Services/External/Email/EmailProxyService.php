<?php
namespace Omea\GestionTelco\PortabilityBundle\Services\External\Email;

use Omea\GestionTelco\PortabilityBundle\Services\External\GenericProxyService;

class EmailProxyService extends GenericProxyService implements EmailServiceInterface
{
    public function notifyPortability($idClient)
    {
        $request = array('idClient' => $idClient,
                         'email' => '',
                         'etape' => 'ECHEC');

        $this->setMethod('notifierPortabilite');

        $result = $this->soapClient->send(array('params' => $request));

        return $result;
    }
}
