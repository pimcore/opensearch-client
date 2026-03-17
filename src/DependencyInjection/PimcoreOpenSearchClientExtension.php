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
            if (isset($clientConfig['dsn']) && $clientConfig['dsn'] !== null && $clientConfig['dsn'] !== '') {
                $clientConfig = $this->parseDsn($clientConfig['dsn'], $clientConfig);
            }

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
     * Parse DSN into config array, merging with existing config.
     * DSN format: opensearch://user:pass@host:port?ssl_verify=bool
     *
     * DSN values override file-based config for: hosts, username, password, ssl_verification.
     * Other config keys (logger_channel, aws_*, ssl_key, ssl_cert) remain from file config.
     */
    private function parseDsn(string $dsn, array $config): array
    {
        $parsed = parse_url($dsn);
        if ($parsed === false) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid OpenSearch DSN: "%s"',
                $dsn,
            ));
        }

        $host = $parsed['host'] ?? 'localhost';
        $port = $parsed['port'] ?? 9200;
        $config['hosts'] = [sprintf('%s:%d', $host, $port)];

        if (isset($parsed['user'])) {
            $config['username'] = rawurldecode($parsed['user']);
        }
        if (isset($parsed['pass'])) {
            $config['password'] = rawurldecode($parsed['pass']);
        }

        if (isset($parsed['query'])) {
            parse_str($parsed['query'], $queryParams);
            if (isset($queryParams['ssl_verify'])) {
                $config['ssl_verification'] = $queryParams['ssl_verify'] === 'true';
            }
        }

        return $config;
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
