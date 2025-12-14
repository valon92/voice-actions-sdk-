<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Sentry\Laravel\Integration;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        // Integrate Sentry for error tracking
        $this->reportable(function (Throwable $e) {
            // Send to Sentry if DSN is configured
            if (config('sentry.dsn')) {
                Integration::captureUnhandledException($e);
            }
            
            // Also log to Laravel logs
            if (app()->bound('log')) {
                \Log::error('Exception occurred', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'url' => request()->fullUrl(),
                    'method' => request()->method(),
                    'platform_id' => request()->input('api_platform_id'),
                    'user_agent' => request()->userAgent(),
                    'ip' => request()->ip(),
                ]);
            }
        });
    }

    public function render($request, Throwable $e)
    {
        // Always return JSON for API routes
        if ($request->is('api/*') || $request->expectsJson()) {
            if ($e instanceof ValidationException) {
                return new JsonResponse([
                    'success' => false,
                    'error' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }

            if ($e instanceof AuthenticationException) {
                return new JsonResponse([
                    'success' => false,
                    'error' => 'Unauthenticated'
                ], 401);
            }

            if ($e instanceof ModelNotFoundException) {
                return new JsonResponse([
                    'success' => false,
                    'error' => 'Resource not found'
                ], 404);
            }

            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
            $message = config('app.debug') ? $e->getMessage() : 'An error occurred';
            
            // Log error for debugging
            if (config('app.debug')) {
                \Log::error('API Error', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            // Return JSON response directly without using response() helper
            return new JsonResponse([
                'success' => false,
                'error' => $message,
                'code' => $e->getCode()
            ], $statusCode);
        }

        return parent::render($request, $e);
    }
}

