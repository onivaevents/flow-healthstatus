<?php

declare(strict_types=1);

namespace Oniva\Flow\HealthStatus\Task;

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

use Neos\FLow\Annotations as Flow;
use Neos\Flow\Configuration\Exception\InvalidConfigurationException;
use Neos\Flow\Core\Booting\Exception\SubProcessException;
use Neos\Flow\Core\Booting\Scripts;

class CommandTask extends AbstractTask
{
    /**
     * @Flow\InjectConfiguration(package="Neos.Flow")
     *
     * @var mixed[]
     */
    protected $flowSettings;

    /**
     * @param mixed[] $options
     *
     * @throws InvalidConfigurationException
     */
    protected function validateOptions(array $options): void
    {
        if (! isset($options['command'])) {
            throw new InvalidConfigurationException('"command" task needs a "command" option', 1502701492);
        }
    }

    /**
     * @throws SubProcessException
     */
    public function run(): void
    {
        $success = Scripts::executeCommand($this->options['command'], $this->flowSettings, false, $this->options['arguments'] ?? []);
        if (! $success) {
            throw new SubProcessException(sprintf('Command "%s" did not return true', $this->options['command']), 1511529104);
        }
    }
}
