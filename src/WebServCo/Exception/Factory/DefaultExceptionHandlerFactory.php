<?php

declare(strict_types=1);

namespace WebServCo\Exception\Factory;

use Psr\Log\LoggerInterface;
use WebServCo\Exception\Contract\ExceptionHandlerFactoryInterface;
use WebServCo\Exception\Contract\ExceptionHandlerInterface;
use WebServCo\Exception\Contract\UncaughtExceptionHandlerInterface;
use WebServCo\Exception\Service\DefaultExceptionHandler;
use WebServCo\Exception\Service\DefaultUncaughtExceptionHandler;

final class DefaultExceptionHandlerFactory implements ExceptionHandlerFactoryInterface
{
    public function createExceptionHandler(LoggerInterface $logger): ExceptionHandlerInterface
    {
        return new DefaultExceptionHandler($logger);
    }

    public function createUncaughtExceptionHandler(LoggerInterface $logger): UncaughtExceptionHandlerInterface
    {
        return new DefaultUncaughtExceptionHandler($logger);
    }
}
