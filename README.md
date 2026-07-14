# Pimcore Opensearch Client
This bundle provides a central configuration and factory for creating Opensearch clients to be used in other bundles.

It allows to configure one or more Opensearch clients with different configuration settings. The corresponding settings are then registered as services and can be injected into any services.

## Compatibility with OpenSearch

| Pimcore Client Version | OpenSearch Version |
|------------------------|--------------------|
| >= 1.0                 | >= 1.0, < 3.0      |

OpenSearch 3 is not supported yet: all client versions ship the
`opensearch-project/opensearch-php` client in version `^2.2`, which targets
OpenSearch 1.x and 2.x servers.

## Documentation Overview
- [Installation](./doc/01_Installation/README.md)
- [Configuration](./doc/02_Configuration.md)
- [Usage](./doc/03_Usage.md)
