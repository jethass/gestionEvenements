<?php

namespace Omea\GestionTelco\EvenementBundle;

use Doctrine\DBAL\Types\Type;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Bridge\Doctrine\RegistryInterface;

class OmeaGestionTelcoEvenementBundle extends Bundle
{
    public function boot()
    {
        $em = $this->container->get('doctrine.orm.default_entity_manager');
        #Type::addType('trame_type', 'Omea\GestionTelco\EvenementBundle\Types\TrameType');
        #$em->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('TrameType','trame_type');
    }
}
