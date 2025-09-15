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
class TestRunner extends AbstractTaskRunner
{
    /**
     * @Flow\InjectConfiguration("testChain")
     *
     * @var mixed[]
     */
    protected $chain;

    /**
     * @Flow\InjectConfiguration("defaultTestCondition")
     *
     * @var string
     */
    protected $defaultCondition;

    /**
     * @var string
     */
    protected $defaultTaskClassName = 'Oniva\Flow\HealthStatus\Test\%sTest';

    /**
     * @var bool
     */
    protected $stopOnFail = true;

    /**
     * @var string
     */
    protected $context = EelRuntime::CONTEXT_TEST;

    public function onBeforeTest(\Closure $onBeforeTest): void
    {
        $this->onBeforeTask($onBeforeTest);
    }

    public function onTestResult(\Closure $onTestResult): void
    {
        $this->onTaskResult($onTestResult);
    }
}
