<?php

namespace App\Exceptions;

use BadMethodCallException;
use ErrorException;
use Flugg\Responder\Exceptions\Http\RelationNotFoundException;
use Flugg\Responder\Exceptions\Http\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Exceptions\PostTooLargeException;
use InvalidArgumentException;
use Psr\Log\LogLevel;
use RuntimeException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use TypeError;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

      public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof ModelNotFoundException) {
                return responder()->error(404, substr($exception->getModel(), strrpos($exception->getModel(), '\\') + 1).' Record not found.')->respond();
            }

            $this->renderable(function (UnauthorizedException $exception, $request) {
                return responder()->error(401, __($exception->getMessage()))->respond();
            });

            if ($exception instanceof NotFoundHttpException) {
                return responder()->error(404, __('This url is not found'))->respond();
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return responder()->error(500, __($exception->getMessage()))->respond();
            }

            if ($exception instanceof RelationNotFoundException) {
                return responder()->error(500, __($exception->getMessage()))->respond();
            }

            if ($exception instanceof AuthorizationException) {
                return responder()->error(401, __('This action is unauthorized'))->respond();
            }

            if ($exception instanceof UnauthorizedException) {
                return responder()->error(401, __('You does not have the right roles'))->respond();
            }

            if ($exception instanceof BindingResolutionException) {
                return responder()->error(500, __($exception->getMessage()))->respond();
            }

            if ($exception instanceof InvalidArgumentException) {
                return responder()->error(500, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }

            if ($exception instanceof RuntimeException) {
                return responder()->error(500, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }

            if ($exception instanceof TypeError) {
                return responder()->error(500, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }

            if ($exception instanceof FatalError) {
                return responder()->error(500, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }

            if ($exception instanceof BadMethodCallException) {
                return responder()->error(500, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }

            if ($exception instanceof PostTooLargeException) {
                return responder()->error(413, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }

            if ($exception instanceof RequestException) {
                return responder()->error(500, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }
            // BadMethodCallException
            if ($exception instanceof ErrorException) {
                return responder()->error(500, __($exception->getMessage()))->data(['file' => $exception->getFile(), 'line' => $exception->getLine()])->respond();
            }
        }

        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
