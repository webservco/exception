<?php

declare(strict_types=1);

namespace WebServCo\Exception\Service;

use Psr\Log\LoggerInterface;
use Throwable;
use WebServCo\Exception\Contract\ExceptionHandlerInterface;

use function error_log;

/**
 * An abstract ExceptionHandler class that can be extended by classes implementing the ExceptionHandlerInterface.
 */
abstract class AbstractExceptionHandler implements ExceptionHandlerInterface
{
    public function __construct(protected LoggerInterface $logger)
    {
    }

    public function log(Throwable $throwable): bool
    {
        // Log to custom application log.
        $this->logger->error($throwable->getMessage(), ['throwable' => $throwable]);

        // Log to system log.
        return error_log(
            $throwable->getMessage(),
            /**
             * message_type
             * 0: message is sent to PHP's system logger
             */
            0,
        );
    }
}
