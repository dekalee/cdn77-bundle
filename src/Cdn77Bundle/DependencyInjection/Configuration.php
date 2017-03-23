<?php

namespace Dekalee\Cdn77Bundle\DependencyInjection;

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
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
