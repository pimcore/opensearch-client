# Upgrade Information
Following steps are necessary during updating to newer versions.

## Upgrade to 2026.4.0
- Removed the `conflict` with `opensearch-project/opensearch-php` `>= 2.4`. The constraint stays `^2.2`, so
  Composer may now install the 2.4 to 2.7 client. opensearch-php 2.4.6 and later are tested upstream against
  OpenSearch 3; this is the prerequisite for running the bundle against an OpenSearch 3 cluster. Projects that
  must stay on the older client can pin `opensearch-project/opensearch-php` themselves.
- **Staying on the previous client:** opensearch-php 2.4 to 2.7 work on OpenSearch 2 as well, so no pin is
  needed to stay on OpenSearch 2. To keep the 2.3 client anyway (for example to avoid the deprecation notices),
  add the pin to the project's root `composer.json` before the next `composer update`:

  ```json
  {
      "require": {
          "opensearch-project/opensearch-php": "^2.2 <2.4"
      }
  }
  ```

- Nothing changes in the bundle's API: `OpenSearchClientFactory` still builds the client through
  `OpenSearch\ClientBuilder`, the `SearchClient` adapter is unchanged, and responses are still plain arrays.
- opensearch-php 2.4 deprecates `OpenSearch\ClientBuilder` (replaced by `OpenSearch\SymfonyClientFactory` /
  `OpenSearch\GuzzleClientFactory`) and the `OpenSearch\Common\Exceptions` namespace (moved to
  `OpenSearch\Exception`). Both still exist in every 2.x release and are removed in opensearch-php 3.0 only.
  Loading `ClientBuilder` emits an `E_USER_DEPRECATED` notice that Symfony records in the deprecation log; it
  does not fail requests. The factory migration follows once the bundle raises its minimum to `^2.4`.
- Code that catches `OpenSearch\Common\Exceptions\*` keeps working; switch to `OpenSearch\Exception\*` once
  your own minimum is `^2.4`.
- OpenSearch 3 creates `knn_vector` indices with derived source enabled by default
  (`index.knn.derived_source.enabled: true`). OpenSearch documents nested fields as unsupported for derived
  source; set the setting to `false` on the index if reads of nested vectors fail.
