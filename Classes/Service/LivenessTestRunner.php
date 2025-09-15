<?php

declare(strict_types=1);

namespace Oniva\Flow\HealthStatus\Service;

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

use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class LivenessTestRunner extends TestRunner
{
    /**
     * @Flow\InjectConfiguration("livenessChain")
     *
     * @var mixed[]
     */
    protected $chain;

    /**
     * @var string
     */
    protected $defaultTaskClassName = 'Oniva\Flow\HealthStatus\LivenessTest\%sTest';
}
