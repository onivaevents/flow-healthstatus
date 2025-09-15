<?php

declare(strict_types=1);

namespace Oniva\Flow\HealthStatus\Test;

/**
 * This file is part of the Oniva.Flow.HealthStatus package.
 *
 * (c) 2018 yeebase media GmbH
 * (c) 2025 Oniva AG
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Oniva\Flow\HealthStatus\Task\TaskInterface;

interface TestInterface extends TaskInterface
{
    public function test(): bool;
}
