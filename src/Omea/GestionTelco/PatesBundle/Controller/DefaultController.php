<?php

namespace Omea\GestionTelco\PatesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OmeaGestionTelcoPatesBundle:Default:index.html.twig', array('name' => $name));
    }
}
