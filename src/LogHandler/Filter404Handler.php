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

namespace Pimcore\Bundle\OpenSearchClientBundle\LogHandler;

use Monolog\Handler\AbstractHandler;
use Monolog\Level;
use Monolog\LogRecord;

/**
 * Ignores warning messages for 404 errors as they are spamming the logs
 *
 * @internal
 */
final class Filter404Handler extends AbstractHandler
{
    private bool $ignoreNextResponseWarning = false;

    public function isHandling(LogRecord $record): bool
    {
        $ignore =
            $record->level === Level::Warning
            && ($record->context['HTTP code'] ?? null) === 404;
        if ($ignore) {
            $this->ignoreNextResponseWarning = true;
        } else {
            $ignore = $this->ignoreNextResponseWarning
                && $record->level === Level::Warning
                && $record->message === 'Response';
            $this->ignoreNextResponseWarning = false;
        }

        return $ignore;
    }

    public function handle(LogRecord $record): bool
    {
        return $this->isHandling($record);
    }
}
