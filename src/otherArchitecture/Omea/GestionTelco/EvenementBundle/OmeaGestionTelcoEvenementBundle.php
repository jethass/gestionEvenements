<?php

namespace Omea\GestionTelco\EvenementBundle;

use Omea\GestionTelco\EvenementBundle\DependencyInjection\CompilerPass\ActeCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OmeaGestionTelcoEvenementBundle extends Bundle
{
public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ActeCompilerPass());
    }
}
