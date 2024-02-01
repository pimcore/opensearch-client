<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under following license:
 * - Pimcore Commercial License (PCL)
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     PCL
 */


namespace Pimcore\Bundle\OpenSearchClientBundle\DependencyInjection;

use Exception;

use OpenSearch\Client;
use Pimcore\Bundle\OpenSearchClientBundle\OpenSearchClientFactory;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @internal
 */
final class PimcoreOpenSearchClientExtension extends ConfigurableExtension implements PrependExtensionInterface
{

    const CLIENT_SERVICE_PREFIX = 'pimcore.open_search_client.';

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');

        foreach ($mergedConfig['clients'] as $clientName => $clientConfig) {
            $definition = new Definition(Client::class);
            $definition->setFactory([OpenSearchClientFactory::class, 'createOpenSearchClient']);
            $definition->setArgument('$logger', new Reference('logger'));
            $definition->setArgument('$config', $clientConfig);
            $definition->addTag('monolog.logger', ['channel' => $clientConfig['logger_channel']]);
            $definition->setPublic(true);
            $container->setDefinition(self::CLIENT_SERVICE_PREFIX . $clientName, $definition);
        }
    }

    /**
     * @throws Exception
     */
    public function prepend(ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('default_config.yaml');
    }
}