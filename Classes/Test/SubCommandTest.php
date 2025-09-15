<?php

declare(strict_types=1);

namespace Oniva\Flow\HealthStatus\Test;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Configuration\Exception\InvalidConfigurationException;
use Neos\Flow\Core\Booting\Exception\SubProcessException;
use Neos\Flow\Core\Booting\Scripts;

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
class SubCommandTest extends AbstractTest
{
    /**
     * @Flow\InjectConfiguration(package="Neos.Flow")
     *
     * @var string[][]
     */
    protected $flowSettings;

    /**
     * @param mixed[] $options
     *
     * @throws InvalidConfigurationException
     */
    protected function validateOptions(array $options): void
    {
        if (! isset($options['commandIdentifier'])) {
            throw new InvalidConfigurationException('The command identifier of the sub-command to execute must be provided', 1596028979);
        }
    }

    /**
     * @throws SubProcessException
     */
    public function test(): bool
    {
        return $this->dispatchCommand(
            $this->options['commandIdentifier'],
            $this->options['commandArguments'] ?? [],
            $this->options['commandContext'] ?? ''
        );
    }

    /**
     * @param string $commandIdentifier the identifier of the flow command
     * @param string[] $commandArguments
     * @param string $commandContext the context the sub command runs in
     *
     * @throws SubProcessException
     */
    private function dispatchCommand(string $commandIdentifier, array $commandArguments = [], string $commandContext = ''): bool
    {
        if (! empty($commandContext)) {
            $this->flowSettings['core']['context'] = $commandContext;
        }

        ob_start();
        $result =  Scripts::executeCommand($commandIdentifier, $this->flowSettings, true, $commandArguments);
        ob_clean();
        return $result;
    }
}
