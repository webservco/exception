# webservco/exception

A PHP component/library.

Custom application exception handling.

---

## Usage

Implement interfaces:

### `ExceptionHandlerFactoryInterface`

```php
interface ExceptionHandlerFactoryInterface
{
    public function createExceptionHandler(LoggerInterface $logger): ExceptionHandlerInterface;
}
```

### `ExceptionHandlerInterface`

```php
interface ExceptionHandlerInterface
{
    public function handle(Throwable $throwable): void;
}
```

### `UncaughtExceptionHandlerInterface`

```php
interface UncaughtExceptionHandlerInterface extends ExceptionHandlerInterface
{
}
```

---

## Example implementation

### Handle uncaught exceptions.

In application bootstrap:

```php
// Exception handling.
$exceptionHandlerFactory = new DefaultExceptionHandlerFactory();
// Uncaught exception handler.
set_exception_handler([$exceptionHandlerFactory->createUncaughtExceptionHandler($logger), 'handle']);
```

### Handle exceptions inside the application (caught exceptions)

In application logic:

```php
$exceptionHandler = $exceptionHandlerFactory->createExceptionHandler($logger);

// Example: an exception handling middleware.
final class ExceptionHandlerMiddleware implements MiddlewareInterface
{
    public function __construct(
        // Exception handler to use to handle the exception.
        private ExceptionHandlerInterface $exceptionHandler,
        // Request handler to use to return a response to the client
        private RequestHandlerInterface $requestHandler,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            /**
             * Pass to the next handler.
             * If all is OK, nothing else to do.
             */
            return $handler->handle($request);
        } catch (Throwable $throwable) {
            /**
             * An exception happened inside one of the next handlers.
             */

            // Handle error (log, report, etc)
            $this->exceptionHandler->handle($throwable);

            /**
             * Return a response via the request handler.
             * Any exceptions that happen here will bubble up and be handled by the uncaught exception handler (if set).
             */
            return $this->requestHandler->handle($request->withAttribute('throwable', $throwable));
        }
    }
}
```
