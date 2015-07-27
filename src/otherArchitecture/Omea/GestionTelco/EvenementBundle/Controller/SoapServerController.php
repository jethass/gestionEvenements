<?php

namespace Omea\GestionTelco\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Soap\Server;
use Zend\Soap\Server\DocumentLiteralWrapper;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeComplex;
use Symfony\Component\HttpFoundation\Response;

class SoapServerController extends Controller
{
    /**
     * WSDL & XSD de gestionTelcoEvenement
     *
     * @return Response
     */
    public function wsdlAction($xsd = null)
    {
        $xsdFile = $this->get('file_locator')->locate('@OmeaGestionTelcoEvenementBundle/Resources/wsdl/' . $xsd);
        return new Response(file_get_contents($xsdFile), 200, array('Content-Type' => 'text/xml'));
    }

    /**
     * Run the Soap server.
     *
     * @return Response
     */
    public function soapAction()
    {
        $wsdlUri = $this
            ->get('router')
            ->generate('omea_gestion_telco_evenement_soap_server_wsdl', array(), true);

        $options = array(
            'classmap' => array(
                'SaveEvenementRequest' => 'Omea\\GestionTelco\\EvenementBundle\\Types\\SaveEvenementRequest',
                'SaveEvenementResponse' => 'Omea\\GestionTelco\\EvenementBundle\\Types\\SaveEvenementResponse',
            ),
            'returnResponse' => false,
            'cache_wsdl' => WSDL_CACHE_NONE,
        );

        $soapServer = new Server($wsdlUri, $options);
        $soapServer->setObject(new DocumentLiteralWrapper($this->get('omea_gestion_telco_evenement.services.evenements')));
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');

        $response->setContent($soapServer->handle());

        return $response;
    }
}
