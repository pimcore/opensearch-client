<?php
declare(strict_types=1);

/**
 * This source file is available under the terms of the
 * Pimcore Open Core License (POCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (https://www.pimcore.com)
 *  @license    Pimcore Open Core License (POCL)
 */

namespace Pimcore\Bundle\OpenSearchClientBundle\DependencyInjection;

use Exception;

use OpenSearch\Client;
use Pimcore\Bundle\OpenSearchClientBundle\OpenSearchClientFactory;
use Pimcore\Bundle\OpenSearchClientBundle\SearchClient\SearchClient;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * @internal
 */
final class PimcoreOpenSearchClientExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    const CLIENT_SERVICE_PREFIX = 'pimcore.open_search_client.';

    const PIMCORE_CLIENT_PREFIX = 'pimcore.openSearch.custom_client.';

    /**
     *
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

            $customClientDefinition = new Definition(SearchClient::class);
            $customClientDefinition->setArgument('$client', $definition);
            $customClientDefinition->setPublic(true);
            $container->setDefinition(self::PIMCORE_CLIENT_PREFIX . $clientName, $customClientDefinition);
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
