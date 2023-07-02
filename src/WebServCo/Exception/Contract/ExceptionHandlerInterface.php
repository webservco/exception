<?php

declare(strict_types=1);

namespace WebServCo\Exception\Contract;

use Throwable;

interface ExceptionHandlerInterface
{
    public function handle(Throwable $throwable): void;
}
