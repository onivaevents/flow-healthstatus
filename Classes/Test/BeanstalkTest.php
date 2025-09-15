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

use Neos\Flow\Configuration\Exception\InvalidConfigurationException;
use Pheanstalk\Pheanstalk;

class BeanstalkTest extends AbstractTest
{
    /**
     * @param mixed[] $options
     *
     * @throws InvalidConfigurationException
     */
    protected function validateOptions(array $options): void
    {
        if (! isset($options['hostname'])) {
            throw new InvalidConfigurationException('Beanstalk readiness test needs a "hostname" option', 1502701630);
        }
    }

    public function test(): bool
    {
        $beanstalkClient = new Pheanstalk($this->options['hostname']);
        return $beanstalkClient->getConnection()->isServiceListening();
    }
}
