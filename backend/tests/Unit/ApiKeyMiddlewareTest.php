<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\ApiKeyMiddleware;
use Closure;

class ApiKeyMiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createTables();
    }

    protected function tearDown(): void
    {
        DB::statement('DROP TABLE IF EXISTS platforms');
        parent::tearDown();
    }

    private function createTables(): void
    {
        DB::statement('CREATE TABLE IF NOT EXISTS platforms (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255) NOT NULL,
            api_key VARCHAR(255) NOT NULL,
            api_key_hash VARCHAR(255) NOT NULL,
            email VARCHAR(255),
            website VARCHAR(255),
            plan VARCHAR(50) DEFAULT "free",
            status VARCHAR(50) DEFAULT "active",
            created_at DATETIME,
            updated_at DATETIME
        )');
    }

    private function createPlatform(): array
    {
        $apiKey = 'va_test_' . uniqid();
        $apiKeyHash = Hash::make($apiKey);

        $platformId = DB::table('platforms')->insertGetId([
            'name' => 'Test Platform',
            'api_key' => $apiKey,
            'api_key_hash' => $apiKeyHash,
            'plan' => 'free',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return ['id' => $platformId, 'api_key' => $apiKey];
    }

    public function test_middleware_rejects_request_without_api_key(): void
    {
        $middleware = new ApiKeyMiddleware();
        $request = Request::create('/api/test', 'GET');

        $response = $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertJson($response->getContent());
        $data = json_decode($response->getContent(), true);
        $this->assertFalse($data['success']);
        $this->assertStringContainsString('API key required', $data['error']);
    }

    public function test_middleware_accepts_bearer_token(): void
    {
        $platform = $this->createPlatform();
        $middleware = new ApiKeyMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $platform['api_key']);

        $called = false;
        $response = $middleware->handle($request, function ($req) use (&$called) {
            $called = true;
            $this->assertEquals($req->input('api_platform_id'), 1);
            return response()->json(['success' => true]);
        });

        $this->assertTrue($called);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_middleware_accepts_x_api_key_header(): void
    {
        $platform = $this->createPlatform();
        $middleware = new ApiKeyMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->headers->set('X-API-Key', $platform['api_key']);

        $called = false;
        $response = $middleware->handle($request, function ($req) use (&$called) {
            $called = true;
            return response()->json(['success' => true]);
        });

        $this->assertTrue($called);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_middleware_rejects_invalid_api_key(): void
    {
        $middleware = new ApiKeyMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->headers->set('X-API-Key', 'invalid_key');

        $response = $middleware->handle($request, function ($req) {
            return response()->json(['success' => true]);
        });

        $this->assertEquals(401, $response->getStatusCode());
        $data = json_decode($response->getContent(), true);
        $this->assertFalse($data['success']);
        $this->assertStringContainsString('Invalid or inactive', $data['error']);
    }

    public function test_middleware_attaches_platform_info_to_request(): void
    {
        $platform = $this->createPlatform();
        $middleware = new ApiKeyMiddleware();
        $request = Request::create('/api/test', 'GET');
        $request->headers->set('X-API-Key', $platform['api_key']);

        $middleware->handle($request, function ($req) use ($platform) {
            $this->assertEquals($platform['id'], $req->input('api_platform_id'));
            $this->assertEquals('free', $req->input('api_platform_plan'));
            return response()->json(['success' => true]);
        });
    }
}

