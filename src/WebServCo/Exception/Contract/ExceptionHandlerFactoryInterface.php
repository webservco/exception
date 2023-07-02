<?php

declare(strict_types=1);

namespace WebServCo\Exception\Contract;

use Psr\Log\LoggerInterface;

interface ExceptionHandlerFactoryInterface
{
    public function createExceptionHandler(LoggerInterface $logger): ExceptionHandlerInterface;
}
