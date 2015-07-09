<?php

namespace Omea\GestionTelco\PortabilityBundle;

use Omea\GestionTelco\PortabilityBundle\DependencyInjection\CompilerPass\QueueCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OmeaGestionTelcoPortabilityBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new QueueCompilerPass());
    }
}
