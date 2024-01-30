<?php
declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under following license:
 * - GNU General Public License version 3 (GPLv3)
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3
 */

namespace Pimcore\Bundle\OpensearchClientBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;
use Pimcore\Extension\Bundle\Installer\InstallerInterface;

class PimcoreOpensearchClientBundle extends AbstractPimcoreBundle
{
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

    public function getInstaller(): ?InstallerInterface
    {
        parent::getInstaller();

        /** @var InstallerInterface|null */
        return $this->container->get(Installer::class);
    }
}
