# Upgrade Information
Following steps are necessary during updating to newer versions.

## Upgrade to 2026.1.0
- Added DSN-based configuration support. The OpenSearch client can now be configured via a single DSN string using the `PIMCORE_OPENSEARCH_DSN` environment variable (e.g. `opensearch://admin:secret@opensearch:9200?ssl=true&ssl_verify=false`). The DSN is parsed at runtime in the client factory and overrides individual `hosts`, `username`, `password`, and `ssl_verification` settings. SSL defaults to `true` (HTTPS) when using DSN.
- Added support to `PHP` `8.5`.
- Removed support to `PHP` `8.3` and Symfony `v6`.

 