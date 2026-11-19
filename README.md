# Pimcore Opensearch Client
This bundle provides a central configuration and factory for creating Opensearch clients to be used in other bundles.

It allows to configure one or more Opensearch clients with different configuration settings. The corresponding settings are then registered as services and can be injected into any services.

## Compatibility with OpenSearch

| Pimcore Client Version | OpenSearch Version | opensearch-project/opensearch-php |
|------------------------|--------------------|-----------------------------------|
| >= 1.0, < 2026.4       | >= 1.0, < 3.0      | ^2.2, < 2.4                       |
| >= 2026.4              | >= 1.0, 2.x, 3.x   | ^2.2                              |

OpenSearch 3 requires `opensearch-project/opensearch-php` 2.4.6 or later, the first client release
tested against OpenSearch 3 upstream. Bundle versions before 2026.4 pin the client below 2.4.
See [Upgrade](./doc/04_Upgrade.md).

## Documentation Overview
- [Installation](./doc/01_Installation/README.md)
- [Configuration](./doc/02_Configuration.md)
- [Usage](./doc/03_Usage.md)
- [Upgrade](./doc/04_Upgrade.md)
