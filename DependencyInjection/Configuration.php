<?php

namespace Ruian\TwitterBootstrapBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ruian_twitter_bootstrap');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->scalarNode('engine')->defaultValue('php')->end()
            ->end()
            ->children()
                ->arrayNode('topbars')
                    ->canBeUnset()
                    ->useAttributeAsKey('key')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('title')
                            ->isRequired()
                            ->end()
                            ->scalarNode('title_route')
                            ->isRequired()
                            ->end()
                            ->variableNode('title_route_parameters')
                            ->defaultValue(array())
                            ->end()
                            ->arrayNode('nav')
                                ->canBeUnset()
                                ->useAttributeAsKey('key')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('name')
                                        ->isRequired()
                                        ->end()
                                        ->scalarNode('route')
                                        ->isRequired()
                                        ->end()
                                        ->variableNode('route_parameters')
                                        ->defaultValue(array())
                                        ->end()
                                        ->arrayNode('children')
                                            ->canBeUnset()
                                            ->useAttributeAsKey('key')
                                            ->prototype('array')
                                                ->children()
                                                    ->scalarNode('name')
                                                    ->isRequired()
                                                    ->end()
                                                    ->scalarNode('route')
                                                    ->isRequired()
                                                    ->end()
                                                    ->variableNode('route_parameters')
                                                    ->defaultValue(array())
                                                    ->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
