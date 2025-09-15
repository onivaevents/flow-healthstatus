<?php

declare(strict_types=1);

namespace Oniva\Flow\HealthStatus\Controller;

use Neos\Error\Messages\Result;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Mvc\View\JsonView;
use Oniva\Flow\HealthStatus\Service\LivenessTestRunner;
use Oniva\Flow\HealthStatus\Service\ReadyTaskRunner;
use Oniva\Flow\HealthStatus\Service\TestRunner;
use Oniva\Flow\HealthStatus\Task\TaskInterface;
use Oniva\Flow\HealthStatus\Test\TestInterface;

class HealthStatusController extends ActionController
{
    /**
     * @var string string
     */
    protected $defaultViewObjectName = JsonView::class;

    public function readyAction(): void
    {
        $testRunner = new TestRunner();
        $taskRunner = new ReadyTaskRunner();

        $errors = [];
        $success = [];

        $testRunner->onTestResult(static function (TestInterface $test, Result $result) use (&$errors, &$success): void {
            if ($result->hasErrors()) {
                $errors[] = [
                    'name' => $test->getName(),
                    'error' => $test->getErrorLabel(),
                ];
            } else {
                $success[] = [
                    'name' => $test->getName(),
                    'notice' => $result->hasNotices() ? $test->getNoticeLabel() : 'Done',
                ];
            }
        });

        $taskRunner->onTaskResult(static function (TaskInterface $task, Result $result) use (&$errors, &$success): void {
            if ($result->hasErrors()) {
                $errors[] = [
                    'name' => $task->getName(),
                    'error' => $task->getErrorLabel(),
                ];
            } else {
                $success[] = [
                    'name' => $task->getName(),
                    'notice' => $result->hasNotices() ? $task->getNoticeLabel() : 'Done',
                ];
            }
        });

        $testRunner->run();
        $taskRunner->run();

        if (count($errors) > 0) {
            $this->response->setStatusCode(500);
        }

        $this->view->assign('value', ['isReady' => count($errors) === 0, 'errors' => $errors, 'success' => $success]);
    }

    public function liveAction(): void
    {
        $testRunner = new LivenessTestRunner();
        $errors = [];
        $success = [];

        $testRunner->onTestResult(static function (TestInterface $test, Result $result) use (&$errors, &$success): void {
            if ($result->hasErrors()) {
                $errors[] = [
                    'name' => $test->getName(),
                    'error' => $test->getErrorLabel(),
                ];
            } else {
                $success[] = [
                    'name' => $test->getName(),
                ];
            }
        });

        $testRunner->run();

        if (count($errors) > 0) {
            $this->response->setStatusCode(500);
        }

        $this->view->assign('value', ['isAlive' => count($errors) === 0, 'errors' => $errors, 'success' => $success]);
    }
}
