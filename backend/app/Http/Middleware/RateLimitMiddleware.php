<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Sentry\State\Scope;

class RateLimitMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Checks rate limits based on platform plan and returns 429 if exceeded.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $platformId = $request->input('api_platform_id');
        
        if (!$platformId) {
            // If no platform ID, skip rate limiting (shouldn't happen if ApiKeyMiddleware runs first)
            return $next($request);
        }

        // Get rate limits for this platform
        $rateLimits = DB::table('api_rate_limits')
            ->where('platform_id', $platformId)
            ->first();

        if (!$rateLimits) {
            // If no rate limits found, use default limits
            $rateLimits = (object) [
                'requests_per_minute' => 60,
                'requests_per_hour' => 1000,
                'requests_per_day' => 10000,
            ];
        }

        $now = now();
        $cachePrefix = "rate_limit:platform:{$platformId}";

        // Check per-minute limit
        $minuteKey = "{$cachePrefix}:minute:" . $now->format('Y-m-d-H-i');
        $minuteCount = Cache::get($minuteKey, 0);
        
        if ($minuteCount >= $rateLimits->requests_per_minute) {
            // Log rate limit exceeded to Sentry
            if (config('sentry.dsn')) {
                \Sentry\configureScope(function (Scope $scope) use ($platformId, $rateLimits): void {
                    $scope->setTag('rate_limit_type', 'minute');
                    $scope->setTag('platform_id', (string) $platformId);
                    $scope->setContext('rate_limit', [
                        'limit' => $rateLimits->requests_per_minute,
                        'current' => $minuteCount,
                    ]);
                });
                \Sentry\captureMessage('Rate limit exceeded (per minute)', 'warning');
            }
            
            return response()->json([
                'success' => false,
                'error' => 'Rate limit exceeded. Too many requests per minute.',
                'limit' => $rateLimits->requests_per_minute,
                'retry_after' => 60 - $now->second,
            ], 429)->header('Retry-After', 60 - $now->second);
        }

        // Check per-hour limit
        $hourKey = "{$cachePrefix}:hour:" . $now->format('Y-m-d-H');
        $hourCount = Cache::get($hourKey, 0);
        
        if ($hourCount >= $rateLimits->requests_per_hour) {
            // Log rate limit exceeded to Sentry
            if (config('sentry.dsn')) {
                \Sentry\configureScope(function (Scope $scope) use ($platformId, $rateLimits): void {
                    $scope->setTag('rate_limit_type', 'hour');
                    $scope->setTag('platform_id', (string) $platformId);
                    $scope->setContext('rate_limit', [
                        'limit' => $rateLimits->requests_per_hour,
                        'current' => $hourCount,
                    ]);
                });
                \Sentry\captureMessage('Rate limit exceeded (per hour)', 'warning');
            }
            
            return response()->json([
                'success' => false,
                'error' => 'Rate limit exceeded. Too many requests per hour.',
                'limit' => $rateLimits->requests_per_hour,
                'retry_after' => 3600 - ($now->minute * 60 + $now->second),
            ], 429)->header('Retry-After', 3600 - ($now->minute * 60 + $now->second));
        }

        // Check per-day limit
        $dayKey = "{$cachePrefix}:day:" . $now->format('Y-m-d');
        $dayCount = Cache::get($dayKey, 0);
        
        if ($dayCount >= $rateLimits->requests_per_day) {
            // Log rate limit exceeded to Sentry
            if (config('sentry.dsn')) {
                \Sentry\configureScope(function (Scope $scope) use ($platformId, $rateLimits): void {
                    $scope->setTag('rate_limit_type', 'day');
                    $scope->setTag('platform_id', (string) $platformId);
                    $scope->setContext('rate_limit', [
                        'limit' => $rateLimits->requests_per_day,
                        'current' => $dayCount,
                    ]);
                });
                \Sentry\captureMessage('Rate limit exceeded (per day)', 'warning');
            }
            
            return response()->json([
                'success' => false,
                'error' => 'Rate limit exceeded. Too many requests per day.',
                'limit' => $rateLimits->requests_per_day,
                'retry_after' => 86400 - ($now->hour * 3600 + $now->minute * 60 + $now->second),
            ], 429)->header('Retry-After', 86400 - ($now->hour * 3600 + $now->minute * 60 + $now->second));
        }

        // Increment counters
        Cache::put($minuteKey, $minuteCount + 1, now()->addMinutes(2)); // Keep for 2 minutes
        Cache::put($hourKey, $hourCount + 1, now()->addHours(2)); // Keep for 2 hours
        Cache::put($dayKey, $dayCount + 1, now()->addDays(2)); // Keep for 2 days

        // Add rate limit headers to response
        $response = $next($request);
        
        $response->headers->set('X-RateLimit-Limit-Minute', $rateLimits->requests_per_minute);
        $response->headers->set('X-RateLimit-Remaining-Minute', max(0, $rateLimits->requests_per_minute - $minuteCount - 1));
        $response->headers->set('X-RateLimit-Limit-Hour', $rateLimits->requests_per_hour);
        $response->headers->set('X-RateLimit-Remaining-Hour', max(0, $rateLimits->requests_per_hour - $hourCount - 1));
        $response->headers->set('X-RateLimit-Limit-Day', $rateLimits->requests_per_day);
        $response->headers->set('X-RateLimit-Remaining-Day', max(0, $rateLimits->requests_per_day - $dayCount - 1));

        return $response;
    }
}

