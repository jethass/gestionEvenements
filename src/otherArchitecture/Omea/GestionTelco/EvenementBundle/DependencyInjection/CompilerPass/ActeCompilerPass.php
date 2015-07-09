<?php

namespace Omea\GestionTelco\EvenementBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ActeCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $messageQueueService = $container->getDefinition('omea_gestion_telco_evenement.actesmanager');
        $acteServices = $container->findTaggedServiceIds('omea_gestion_telco_evenement.acte');

        foreach ($acteServices as $id => $service) {
            $acte = new Reference($id);

            foreach ($service as $item) {
                if (isset($item['acteName'])) {
                    $acteName = $item['acteName'];
                }
            }
            $messageQueueService->addMethodCall('registerActe', array($acteName, $acte));
        }
    }
}
