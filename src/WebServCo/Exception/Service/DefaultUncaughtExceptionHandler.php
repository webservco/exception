<?php

declare(strict_types=1);

namespace WebServCo\Exception\Service;

use Throwable;
use WebServCo\Exception\Contract\UncaughtExceptionHandlerInterface;

use function http_response_code;
use function in_array;
use function sprintf;

use const PHP_EOL;
use const PHP_SAPI;

final class DefaultUncaughtExceptionHandler extends AbstractExceptionHandler implements
    UncaughtExceptionHandlerInterface
{
    public function handle(Throwable $throwable): void
    {
        $this->log($throwable);

        if (!in_array(PHP_SAPI, ['cli', 'cgi-fcgi'], true)) {
            http_response_code(500);
        }

        echo sprintf('Application exception.%s', PHP_EOL);
    }
}
