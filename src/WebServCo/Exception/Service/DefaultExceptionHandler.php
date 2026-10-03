<?php

declare(strict_types=1);

namespace WebServCo\Exception\Service;

use Override;
use Throwable;
use WebServCo\Exception\Contract\ExceptionHandlerInterface;

final class DefaultExceptionHandler extends AbstractExceptionHandler implements ExceptionHandlerInterface
{
    #[Override]
    public function handle(Throwable $throwable): void
    {
        $this->log($throwable);
    }
}
