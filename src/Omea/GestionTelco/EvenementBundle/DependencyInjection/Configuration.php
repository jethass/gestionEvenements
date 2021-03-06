<?php

namespace Omea\GestionTelco\EvenementBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('omea_gestion_telco_evenement');

        $rootNode
            ->children()
                ->arrayNode('acte_histo_config')
                    ->isRequired()
                        ->children()
                            ->scalarNode('id_conseiller')->isRequired()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('sms_config')
                    ->isRequired()
                        ->children()
                            ->scalarNode('id_template')->isRequired()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('bridge_config')
                    ->isRequired()
                        ->children()
                            ->scalarNode('param1')->isRequired()
                        ->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
