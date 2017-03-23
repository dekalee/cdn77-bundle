<?php

namespace Dekalee\Cdn77Bundle\DependencyInjection;

use Dekalee\Cdn77\Query\CreateResourceQuery;
use Dekalee\Cdn77\Query\ListResourcesQuery;
use Dekalee\Cdn77\Query\PurgeAllQuery;
use Dekalee\Cdn77\Query\PurgeFileQuery;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DekaleeCdn77Extension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('dekalee_cdn77.api.login', $config['login']);
        $container->setParameter('dekalee_cdn77.api.password', $config['password']);

        foreach ([
            'list' => ListResourcesQuery::URL,
            'purge' => PurgeFileQuery::URL,
            'purge_all' => PurgeAllQuery::URL,
            'create' => CreateResourceQuery::URL,
        ] as $queryType => $url) {
            if (array_key_exists($queryType, $config['url'])) {
                $url = $config['url'][$queryType];
            }
            $container->setParameter('dekalee_cdn77.url.' . $queryType, $url);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('query.yml');
    }
}
