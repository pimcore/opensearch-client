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

namespace Pimcore\Bundle\OpenSearchClientBundle;

use Pimcore\Bundle\OpenSearchClientBundle\DependencyInjection\PimcoreOpenSearchClientExtension;
use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class PimcoreOpenSearchClientBundle extends AbstractPimcoreBundle
{
    public function getContainerExtension(): ExtensionInterface
    {
        return new PimcoreOpenSearchClientExtension();
    }

    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function getJsPaths(): array
    {
        return [];
    }

    public function getCssPaths(): array
    {
        return [];
    }
}
