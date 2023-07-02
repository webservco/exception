<?php

declare(strict_types=1);

namespace WebServCo\Exception\Service;

use Throwable;
use WebServCo\Exception\Contract\ExceptionHandlerInterface;

final class DefaultExceptionHandler extends AbstractExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(Throwable $throwable): void
    {
        $this->log($throwable);
    }
}
