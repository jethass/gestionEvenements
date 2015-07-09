<?php
namespace Omea\GestionTelco\PatesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see
 * {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('omea_gestion_telco_pates');

        $rootNode
            ->children()
                ->arrayNode('femto_parameters')
                    ->isRequired()
                    ->children()
                        ->scalarNode('option_id')->isRequired()->end()
                        ->scalarNode('fap_latitude')->isRequired()->end()
                        ->scalarNode('fap_longitude')->isRequired()->end()
                        ->scalarNode('id_art')->isRequired()->end()
                    ->end()
                ->end()
                ->arrayNode('import_service')
                    ->isRequired()
                    ->children()
                        ->scalarNode('data_path')->isRequired()->end()
                    ->end()
                ->end()
                ->arrayNode('order_manager')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('idDis')->isRequired()->end()
                            ->scalarNode('idMag')->isRequired()->end()
                            ->scalarNode('idArt')->isRequired()->end()
                            ->scalarNode('transTraite')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('relais_service')
                    ->isRequired()
                    ->children()
                        ->scalarNode('use_ws_sfr_time_restriction')->isRequired()->end()
                        ->variableNode('error_code_to_skip')->isRequired()->end()
                        ->arrayNode('parameters')
                            ->isRequired()
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('time_start')->defaultValue(null)->end()
                                    ->scalarNode('time_end')->defaultValue(null)->end()
                                    ->scalarNode('interval')->defaultValue(null)->end()
                                    ->variableNode('actions')->isRequired()->end()
                                    ->arrayNode('ws')
                                        ->children()
                                            ->scalarNode('location')->end()
                                            ->scalarNode('wsdl')->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('services')
                            ->isRequired()
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('ws_method')->isRequired()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('user_service')
                    ->isRequired()
                    ->children()
                    ->variableNode('valid_state_code')->isRequired()->end()
                ->end()
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
