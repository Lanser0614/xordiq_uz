<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler {
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
    public function register(): void {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Exception|Throwable $e) {
        if ($e instanceof DataBaseException) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ], $e->getCode());
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ], 404);
        }

        if ($e instanceof BusinessException) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ], $e->getCode());
        }

        return parent::render($request, $e);
    }
}
