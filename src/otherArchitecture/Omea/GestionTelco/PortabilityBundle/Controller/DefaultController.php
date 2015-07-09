<?php

namespace Omea\GestionTelco\PortabilityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OmeaGestionTelcoPortabilityBundle:Default:index.html.twig', array('name' => $name));
    }
}
