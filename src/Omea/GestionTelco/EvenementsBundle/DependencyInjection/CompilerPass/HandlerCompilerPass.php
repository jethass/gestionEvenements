<?php

namespace Omea\GestionTelco\EvenementsBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class HandlerCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('omea_gestion_telco_evenements.evenementmanager')) {
            return;
        }

        $definition = $container->getDefinition(
                'omea_gestion_telco_evenements.evenementmanager'
        );

        $taggedServices = $container->findTaggedServiceIds(
                'omea_gestion_telco_evenements.evenementmanager.handler'
        );
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                    'addHandler', array(new Reference($id))
            );
        }
    }

}
