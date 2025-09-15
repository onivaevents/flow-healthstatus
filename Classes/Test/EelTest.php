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

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Configuration\Exception\InvalidConfigurationException;
use Oniva\Flow\HealthStatus\Service\EelRuntime;

class EelTest extends AbstractTest
{
    /**
     * @Flow\Inject
     *
     * @var EelRuntime
     */
    protected $runtime;

    /**
     * @param mixed[] $options
     *
     * @throws InvalidConfigurationException
     */
    protected function validateOptions(array $options): void
    {
        if (! isset($options['expression'])) {
            throw new InvalidConfigurationException('"expression" not set', 1502701561);
        }
    }

    public function test(): bool
    {
        $this->runtime->setTaskContext('test');
        $result = $this->runtime->evaluate($this->options['expression']);
        return $result ?: false;
    }
}
