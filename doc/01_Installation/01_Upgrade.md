# Upgrade Information
Following steps are necessary during updating to newer versions.

## Upgrade to 2026.1.0

### DSN-Based Configuration Support (New)

- Added DSN-based configuration support for the OpenSearch client. The client can now be configured
  via a single DSN string using the `PIMCORE_OPENSEARCH_DSN` environment variable.
  DSN format: `opensearch://user:pass@host:port?ssl=true&ssl_verify=false`
  - The DSN is parsed at runtime in `OpenSearchClientFactory::createOpenSearchClient()` and overrides
    the individual `hosts`, `username`, `password`, and `ssl_verification` config keys.
  - The `ssl` query parameter controls the protocol (HTTPS when `true`, which is the default).
  - The `ssl_verify` query parameter controls certificate verification independently of `ssl`.
  - Other config keys (`logger_channel`, `aws_*`, `ssl_key`, `ssl_cert`) remain from file-based
    configuration and are not overridden by the DSN.
  - A new `dsn` scalar node has been added to the bundle's `Configuration` class. Existing file-based
    configuration remains fully backward-compatible.

### PHP / Platform Requirements

- Added support for `PHP` `8.5`.
- Removed support for `PHP` `8.3` and Symfony `v6`.

 