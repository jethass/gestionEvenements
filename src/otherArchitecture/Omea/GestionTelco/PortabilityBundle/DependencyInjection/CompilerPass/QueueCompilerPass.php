<?php

namespace Omea\GestionTelco\PortabilityBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class QueueCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $messageQueueService = $container->getDefinition('omea_gestion_telco_portability.services.messagequeue');
        $queueServices = $container->findTaggedServiceIds('omea_gestion_telco_portability.queues');

        foreach ($queueServices as $id => $service) {
            $queue = new Reference($id);

            foreach ($service as $item) {
                if (isset($item['id'])) {
                    $id = $item['id'];
                }
            }
            $messageQueueService->addMethodCall('addQueue', array($id, $queue));
        }
    }
}
