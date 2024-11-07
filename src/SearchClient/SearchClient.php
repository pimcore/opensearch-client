<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Commercial License (PCL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PCL
 */

namespace Pimcore\Bundle\OpenSearchClientBundle\SearchClient;

use Exception;
use OpenSearch\Client;
use Pimcore\SearchClient\Exception\ClientException;

/**
 * @internal
 */
final class SearchClient implements OpenSearchClientInterface
{
    public function __construct(
        private readonly Client $client
    ) {
    }

    public function getOriginalClient(): Client
    {
        return $this->client;
    }

    /**
     * @throws ClientException
     */
    public function create(array $params): array
    {
        try {
            return $this->client->create($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to create data: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function search(array $params): array
    {
        try {
            return $this->client->search($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to search data: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function get(array $params): array
    {
        try {
            return $this->client->get($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to get data: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function exists(array $params): bool
    {
        try {
            return $this->client->exists($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to check if data exists: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function count(array $params): array
    {
        try {
            return $this->client->count($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to count data: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function index(array $params): array
    {
        try {
            return $this->client->index($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Index operation failed: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function bulk(array $params): array
    {
        try {
            return $this->client->bulk($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Bulk operation failed: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function delete(array $params): array
    {
        try {
            return $this->client->delete($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Delete operation failed: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function updateByQuery(array $params): array
    {
        try {
            return $this->client->updateByQuery($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to update by query: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function deleteByQuery(array $params): array
    {
        try {
            return $this->client->deleteByQuery($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to delete by query: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function createIndex(array $params): array
    {
        try {
            return $this->client->indices()->create($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to create index: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function openIndex(array $params): array
    {
        try {
            return $this->client->indices()->open($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to open index: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function closeIndex(array $params): array
    {
        try {
            return $this->client->indices()->close($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to close index: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function getAllIndices(array $params): array
    {
        try {
            return $this->client->cat()->indices($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to get all indices: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function existsIndex(array $params): bool
    {
        try {
            return $this->client->indices()->exists($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to check if index exists: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function reIndex(array $params): array
    {
        try {
            return $this->client->reindex($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to reindex: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function refreshIndex(array $params = []): array
    {
        try {
            return $this->client->indices()->refresh($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to refresh index: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function flushIndex(array $params = []): array
    {
        try {
            return $this->client->indices()->flush($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to flush index: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function deleteIndex(array $params): array
    {
        try {
            return $this->client->indices()->delete($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to delete an index: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function existsIndexAlias(array $params): bool
    {
        try {
            return $this->client->indices()->existsAlias($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to check if Alias exists: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function getIndexAlias(array $params): array
    {
        try {
            return $this->client->indices()->getAlias($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to get an Alias: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function deleteIndexAlias(array $params): array
    {
        try {
            return $this->client->indices()->deleteAlias($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to delete an Alias: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function getAllIndexAliases(array $params): array
    {
        try {
            return $this->client->cat()->aliases($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to get all index Aliases: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function updateIndexAliases(array $params): array
    {
        try {
            return $this->client->indices()->updateAliases($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to update Aliases: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function putIndexMapping(array $params): array
    {
        try {
            return $this->client->indices()->putMapping($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to put Mapping: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function getIndexMapping(array $params): array
    {
        try {
            return $this->client->indices()->getMapping($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to get Mapping: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function getIndexSettings(array $params): array
    {
        try {
            return $this->client->indices()->getSettings($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to get index settings: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function putIndexSettings(array $params): array
    {
        try {
            return $this->client->indices()->putSettings($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to update index settings: %s', $exception->getMessage())
            );
        }
    }

    /**
     * @throws ClientException
     */
    public function getIndexStats(array $params): array
    {
        try {
            return $this->client->indices()->stats($params);
        } catch (Exception $exception) {
            throw new ClientException(
                sprintf('Failed to get index stats: %s', $exception->getMessage())
            );
        }
    }
}
