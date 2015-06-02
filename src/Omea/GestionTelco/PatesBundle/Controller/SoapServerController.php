<?php
namespace Omea\GestionTelco\PatesBundle\Controller;

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
        $uri = $this->get('router')->generate('omea_gestion_telco_pates_soap_server', array(), true);

        $autodiscover = new AutoDiscover();
        $autodiscover->setComplexTypeStrategy(new ArrayOfTypeComplex());
        $autodiscover->setClass('Omea\GestionTelco\PatesBundle\Services\PatesService')
            ->setUri($uri)
            ->setServiceName('wsGestionTelcoPates');

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
        $wsdlUri = $this->get('router')->generate('omea_gestion_telco_pates_soap_server_wsdl', array(), true);

        $options = array(
            'classmap' => array(
                'BaseResponse'               => 'Omea\\GestionTelco\\PatesBundle\\Types\\BaseResponse',
                'EligibilityRequest'         => 'Omea\\GestionTelco\\PatesBundle\\Types\\EligibilityRequest',
                'EligibilityResponse'        => 'Omea\\GestionTelco\\PatesBundle\\Types\\EligibilityResponse',
                'SetAdditionalsListRequest'  => 'Omea\\GestionTelco\\PatesBundle\\Types\\SetAdditionalsListRequest',
                'GetAdditionalsListRequest'  => 'Omea\\GestionTelco\\PatesBundle\\Types\\GetAdditionalsListRequest',
                'GetAdditionalsListResponse' => 'Omea\\GestionTelco\\PatesBundle\\Types\\GetAdditionalsListResponse',
                'CreateOrderRequest'         => 'Omea\\GestionTelco\\PatesBundle\\Types\\CreateOrderRequest',
                'CancellationRequest'        => 'Omea\\GestionTelco\\PatesBundle\\Types\\CancellationRequest',
                'ActivateFAPRequest'         => 'Omea\\GestionTelco\\PatesBundle\\Types\\ActivateFAPRequest',
                'ChangeMsisdnRequest'        => 'Omea\\GestionTelco\\PatesBundle\\Types\\ChangeMsisdnRequest',
                'ChangeImsiRequest'          => 'Omea\\GestionTelco\\PatesBundle\\Types\\ChangeImsiRequest',
                'UserType'                   => 'Omea\\GestionTelco\\PatesBundle\\Types\\Common\\UserType'
            ),
            'returnResponse' => false,
            'cache_wsdl'     => WSDL_CACHE_NONE
        );

        $soapServer = new Server($wsdlUri, $options);
        $soapServer->setObject($this->get('omea_gestion_telco_pates.services.pates'));

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml');

        $response->setContent($soapServer->handle());

        return $response;
    }
}
