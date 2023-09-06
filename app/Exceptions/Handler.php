<?php

namespace App\Exceptions;

use App\Http\Resources\Api\Status;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if ($e instanceof \App\Exceptions\Api\APIErrorException) {
                return false;
            }
            return true;
        });

        $this->renderable(function (Throwable $e) {
            if ($e instanceof \App\Exceptions\Api\APIErrorException) {
                return $e->getErrorResponse();
            }

            return Status::error($e->getMessage(), 500);
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception): Status
    {
        return Status::error('Unauthorized', 401);
    }
}
