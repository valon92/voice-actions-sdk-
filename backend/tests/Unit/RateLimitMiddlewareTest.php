<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Http\Middleware\RateLimitMiddleware;
use Closure;

class RateLimitMiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createTables();
        Cache::flush();
    }

    protected function tearDown(): void
    {
        DB::statement('DROP TABLE IF EXISTS api_rate_limits');
        Cache::flush();
        parent::tearDown();
    }

    private function createTables(): void
    {
        DB::statement('CREATE TABLE IF NOT EXISTS api_rate_limits (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            platform_id INTEGER NOT NULL UNIQUE,
            requests_per_minute INTEGER DEFAULT 60,
            requests_per_hour INTEGER DEFAULT 1000,
            requests_per_day INTEGER DEFAULT 10000,
            created_at DATETIME,
            updated_at DATETIME
        )');
    }

    private function createRateLimit($platformId, $perMinute = 60, $perHour = 1000, $perDay = 10000): void
    {
        DB::table('api_rate_limits')->insert([
            'platform_id' => $platformId,
            'requests_per_minute' => $perMinute,
            'requests_per_hour' => $perHour,
            'requests_per_day' => $perDay,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_middleware_allows_request_within_limits(): void
    {
        $middleware = new RateLimitMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->merge(['api_platform_id' => 1]);

        $this->createRateLimit(1, 60, 1000, 10000);

        $called = false;
        $response = $middleware->handle($request, function ($req) use (&$called) {
            $called = true;
            return response()->json(['success' => true]);
        });

        $this->assertTrue($called);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_middleware_rejects_request_exceeding_minute_limit(): void
    {
        $middleware = new RateLimitMiddleware();
        $platformId = 1;
        $this->createRateLimit($platformId, 2, 1000, 10000); // 2 requests per minute

        // Make 2 requests (within limit)
        for ($i = 0; $i < 2; $i++) {
            $request = Request::create('/api/test', 'GET');
            $request->merge(['api_platform_id' => $platformId]);
            $middleware->handle($request, function ($req) {
                return response()->json(['success' => true]);
            });
        }

        // 3rd request should be rejected
        $request = Request::create('/api/test', 'GET');
        $request->merge(['api_platform_id' => $platformId]);
        $response = $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        $this->assertEquals(429, $response->getStatusCode());
        $data = json_decode($response->getContent(), true);
        $this->assertFalse($data['success']);
        $this->assertStringContainsString('Rate limit exceeded', $data['error']);
    }

    public function test_middleware_adds_rate_limit_headers(): void
    {
        $middleware = new RateLimitMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->merge(['api_platform_id' => 1]);

        $this->createRateLimit(1, 60, 1000, 10000);

        $response = $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        $this->assertTrue($response->headers->has('X-RateLimit-Limit-Minute'));
        $this->assertTrue($response->headers->has('X-RateLimit-Remaining-Minute'));
        $this->assertTrue($response->headers->has('X-RateLimit-Limit-Hour'));
        $this->assertTrue($response->headers->has('X-RateLimit-Remaining-Hour'));
        $this->assertTrue($response->headers->has('X-RateLimit-Limit-Day'));
        $this->assertTrue($response->headers->has('X-RateLimit-Remaining-Day'));

        $this->assertEquals(60, $response->headers->get('X-RateLimit-Limit-Minute'));
        $this->assertEquals(59, $response->headers->get('X-RateLimit-Remaining-Minute'));
    }

    public function test_middleware_uses_default_limits_when_not_found(): void
    {
        $middleware = new RateLimitMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->merge(['api_platform_id' => 999]); // Non-existent platform

        $called = false;
        $response = $middleware->handle($request, function ($req) use (&$called) {
            $called = true;
            return response()->json(['success' => true]);
        });

        // Should use default limits (60/min, 1K/hour, 10K/day)
        $this->assertTrue($called);
        $this->assertEquals(60, $response->headers->get('X-RateLimit-Limit-Minute'));
    }

    public function test_middleware_adds_retry_after_header_on_rate_limit(): void
    {
        $middleware = new RateLimitMiddleware();
        $platformId = 1;
        $this->createRateLimit($platformId, 1, 1000, 10000); // 1 request per minute

        // First request
        $request = Request::create('/api/test', 'GET');
        $request->merge(['api_platform_id' => $platformId]);
        $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        // Second request (should be rate limited)
        $request = Request::create('/api/test', 'GET');
        $request->merge(['api_platform_id' => $platformId]);
        $response = $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        $this->assertEquals(429, $response->getStatusCode());
        $this->assertTrue($response->headers->has('Retry-After'));
        $retryAfter = (int) $response->headers->get('Retry-After');
        $this->assertGreaterThan(0, $retryAfter);
        $this->assertLessThanOrEqual(60, $retryAfter);
    }
}

