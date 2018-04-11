<?php

namespace Dekalee\Cdn77Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link https://symfony.com}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dekalee_cdn77');

        $rootNode->children()
            ->scalarNode('login')->isRequired()->end()
            ->scalarNode('password')->isRequired()->end()
            ->arrayNode('url')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('list')->end()
                    ->scalarNode('create')->end()
                    ->scalarNode('purge')->end()
                    ->scalarNode('purge_all')->end()
                    ->scalarNode('resource_log')->end()
                    ->scalarNode('delete_resource')->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
