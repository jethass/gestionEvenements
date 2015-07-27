<?php
namespace Omea\GestionTelco\PortabilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Soap\Server;
use Zend\Soap\Server\DocumentLiteralWrapper;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeComplex;
use Symfony\Component\HttpFoundation\Response;

class SoapServerController extends Controller
{
    /** Show the "Incoming" wsdl using the zend autodiscover.
     * @return Response
     */
    public function IncomingWsdlAction()
    {
        if (false) {
            $uri = $this->get('router')->generate('omea_gestion_telco_portability_incoming_server', array(), true);
            $autodiscover = new AutoDiscover();
            $autodiscover->setComplexTypeStrategy(new ArrayOfTypeComplex());
            $autodiscover->setClass('Omea\GestionTelco\PortabilityBundle\Services\IncomingPortabilityWebService')
               ->setUri($uri)
               ->setServiceName('wsGestionTelcoIncomingPortability')
               ->setOperationBodyStyle(array("use" => "literal"))
               ->setBindingStyle(array("style" => "document"));
            $wsdl = $autodiscover->generate();
            $response = new Response($wsdl->toXml());
            $response->headers->set('Content-Type', 'text/xml');
            return $response;
        }
        $uri = $this->get('router')->generate('omea_gestion_telco_portability_incoming_server', array(), true);
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $twig = $this->container->get('templating');
        $content = $twig->render("OmeaGestionTelcoPortabilityBundle:wsdl:incomingPortabilityWsdl.xml.twig", array('url_soap_action'=>$uri));
        $response->setContent($content);
        return ($response);
    }

    /** Run the Incoming Soap server.
     * @return Response
     */
    public function IncomingServerAction()
    {
        $wsdlUri = $this->get('router')->generate('omea_gestion_telco_portability_incoming_server_wsdl', array(), true);

        $options = array(
            'classmap' => array(
                'PortabilitySoapFault' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilitySoapFault',
                'PortabilityAcknowledgementRequest' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityAcknowledgementRequest',
                'PortabilityBaseResponse' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityBaseResponse',
                'PortabilityCancellationRequest' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityCancellationRequest',
                'IncomingPortabilityCreationRequest' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\IncomingPortabilityCreationRequest',
                'IncomingPortabilityCreationResponse' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\IncomingPortabilityCreationResponse',
                'PortabilityActivityRequest' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityActivityRequest',
                'PortabilityActivityResponse' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityActivityResponse',
            ),
            'returnResponse' => false,
            'cache_wsdl' => WSDL_CACHE_NONE,
        );
        $soapServer = new Server($wsdlUri, $options);
        $soapServer->setObject(new DocumentLiteralWrapper($this->get('omea_gestion_telco_portability.services.ws.incoming_portability')));
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');

        $response->setContent($soapServer->handle());

        return $response;
    }
    
    /** Show the "Outgoing" wsdl using the zend autodiscover.
     * @return Response
     */
    public function OutgoingWsdlAction()
    {
        if (false) {
            $uri = $this->get('router')->generate('omea_gestion_telco_portability_outgoing_server', array(), true);
            $autodiscover = new AutoDiscover();
            $autodiscover->setComplexTypeStrategy(new ArrayOfTypeComplex());
            $autodiscover->setClass('Omea\GestionTelco\PortabilityBundle\Services\OutgoingPortabilityWebService')
               ->setUri($uri)
               ->setServiceName('wsGestionTelcoOutgoingPortability')
               ->setOperationBodyStyle(array("use" => "literal"))
               ->setBindingStyle(array("style" => "document"));
            $wsdl = $autodiscover->generate();
            $response = new Response($wsdl->toXml());
            $response->headers->set('Content-Type', 'text/xml');
            return $response;
        }
        $uri = $this->get('router')->generate('omea_gestion_telco_portability_outgoing_server', array(), true);
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');
        $twig = $this->container->get('templating');
        $content = $twig->render("OmeaGestionTelcoPortabilityBundle:wsdl:outgoingPortabilityWsdl.xml.twig", array('url_soap_action'=>$uri));
        $response->setContent($content);
        return ($response);
    }

    /** Run the Outgoing Soap server.
     * @return Response
     */
    public function OutgoingServerAction()
    {
        $wsdlUri = $this->get('router')->generate('omea_gestion_telco_portability_outgoing_server_wsdl', array(), true);

        $options = array(
            'classmap' => array(
                'PortabilitySoapFault' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilitySoapFault',
                'PortabilityAcknowledgementRequest' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityAcknowledgementRequest',
                'PortabilityBaseResponse' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityBaseResponse',
                'PortabilityCancellationRequest' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityCancellationRequest',
                'PortabilityActivityRequest' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityActivityRequest',
                'PortabilityActivityResponse' => 'Omea\\GestionTelco\\PortabilityBundle\\Types\\WS\\PortabilityActivityResponse',
            ),
            'returnResponse' => false,
            'cache_wsdl' => WSDL_CACHE_NONE,
        );
        $soapServer = new Server($wsdlUri, $options);
        $soapServer->setObject(new DocumentLiteralWrapper($this->get('omea_gestion_telco_portability.services.ws.outgoing_portability')));
        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');

        $response->setContent($soapServer->handle());

        return $response;
    }
}
