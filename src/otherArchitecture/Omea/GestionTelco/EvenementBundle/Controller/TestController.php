<?php

namespace Omea\GestionTelco\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Soap\Server;
use Zend\Soap\Server\DocumentLiteralWrapper;
use Zend\Soap\AutoDiscover;
use Zend\Soap\Wsdl\ComplexTypeStrategy\ArrayOfTypeComplex;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{

    public function handleEventAction()
    {
         $actesManagerService = $this->container->get('omea_gestion_telco_evenement.actesmanagerservice'); 
         $actesManagerService->handleEvenements();
         
    }


}
