# Installation of the Opensearch Client Bundle

:::info

 This bundle is only supported on Pimcore Core Framework 11.

:::

 ## Bundle Installation

To install the Opensearch Client Bundle, follow the three steps below:

1) Install the required dependencies:

```bash
composer require pimcore/opensearch-client-bundle
```

2) Make sure the bundle is enabled in the `config/bundles.php` file. The following lines should be added:
```php
use Pimcore\Bundle\OpensearchClientBundle\PimcoreOpensearchClientBundle;
// ...
return [
    // ...
    PimcoreOpensearchClientBundle::class => ['all' => true],
    // ...
];  
```

3) Install the bundle:

```bash
bin/console pimcore:bundle:install PimcoreOpensearchClientBundle
```