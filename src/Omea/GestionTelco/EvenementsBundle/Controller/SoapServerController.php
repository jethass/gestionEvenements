<?php
namespace Omea\GestionTelco\EvenementsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zend\Soap\Server;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeComplex;
use Symfony\Component\HttpFoundation\Response;

class SoapServerController extends Controller
{

    /**
     * Show the wsdl using the zend autodiscover
     *
     * @return Response
     */
    public function wsdlAction()
    {
        
        $uri = $this->get('router')->generate('omea_gestion_telco_evenements_soap_server', array(), true);
        $autodiscover = new AutoDiscover();
        $autodiscover->setComplexTypeStrategy(new ArrayOfTypeComplex());
        $autodiscover->setClass('Omea\GestionTelco\EvenementsBundle\Services\EvenementsService')
            ->setUri($uri)
            ->setServiceName('wsGestionTelcoEvenements');

        $wsdl = $autodiscover->generate();
        $response = new Response($wsdl->toXml());
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }

    /**
     * Run the Soap server
     *
     * @return Response
     */
    public function soapAction()
    {
        $wsdlUri = $this->get('router')->generate('omea_gestion_telco_evenements_soap_server_wsdl', array(), true);

        $options = array(
            'classmap' => array(
                'BaseResponse'                 => 'Omea\\GestionTelco\\EvenementsBundle\\Types\\BaseResponse',
                'SaveEvenementRequest'         => 'Omea\\GestionTelco\\EvenementsBundle\\Types\\SaveEvenementRequest',
                'SaveEvenementResponse'        => 'Omea\\GestionTelco\\EvenementsBundle\\Types\\SaveEvenementResponse'
            ),
            'returnResponse' => false,
            'cache_wsdl'     => WSDL_CACHE_NONE
        );

        $soapServer = new Server($wsdlUri, $options);
        $soapServer->setObject($this->get('omea_gestion_telco_evenements.services.evenements'));
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');

        $response->setContent($soapServer->handle());

        return $response;
    }
}
