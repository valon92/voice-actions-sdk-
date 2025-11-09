<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlatformControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createTables();
    }

    protected function tearDown(): void
    {
        DB::statement('DROP TABLE IF EXISTS api_rate_limits');
        DB::statement('DROP TABLE IF EXISTS platforms');
        parent::tearDown();
    }

    private function createTables(): void
    {
        // Create platforms table
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

        // Create api_rate_limits table
        DB::statement('CREATE TABLE IF NOT EXISTS api_rate_limits (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            platform_id INTEGER NOT NULL UNIQUE,
            requests_per_minute INTEGER DEFAULT 60,
            requests_per_hour INTEGER DEFAULT 1000,
            requests_per_day INTEGER DEFAULT 10000,
            created_at DATETIME,
            updated_at DATETIME,
            FOREIGN KEY (platform_id) REFERENCES platforms(id) ON DELETE CASCADE
        )');
    }

    public function test_platform_registration_creates_platform_with_api_key(): void
    {
        $response = $this->postJson('/api/platforms/register', [
            'name' => 'Test Platform',
            'email' => 'test@example.com',
            'website' => 'https://test.com',
            'expected_usage' => 5000,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'platform' => [
                    'id',
                    'name',
                    'api_key',
                    'plan',
                    'status',
                ],
            ]);

        $this->assertTrue($response->json('success'));
        $this->assertEquals('Test Platform', $response->json('platform.name'));
        $this->assertStringStartsWith('va_', $response->json('platform.api_key'));
        $this->assertEquals('free', $response->json('platform.plan'));
    }

    public function test_platform_registration_with_high_usage_creates_pro_plan(): void
    {
        $response = $this->postJson('/api/platforms/register', [
            'name' => 'Pro Platform',
            'expected_usage' => 50000,
        ]);

        $response->assertStatus(201);
        $this->assertEquals('pro', $response->json('platform.plan'));
    }

    public function test_platform_registration_with_very_high_usage_creates_enterprise_plan(): void
    {
        $response = $this->postJson('/api/platforms/register', [
            'name' => 'Enterprise Platform',
            'expected_usage' => 2000000,
        ]);

        $response->assertStatus(201);
        $this->assertEquals('enterprise', $response->json('platform.plan'));
    }

    public function test_platform_registration_creates_rate_limits(): void
    {
        $response = $this->postJson('/api/platforms/register', [
            'name' => 'Test Platform',
            'expected_usage' => 0,
        ]);

        $response->assertStatus(201);
        $platformId = $response->json('platform.id');

        $rateLimits = DB::table('api_rate_limits')
            ->where('platform_id', $platformId)
            ->first();

        $this->assertNotNull($rateLimits);
        $this->assertEquals(60, $rateLimits->requests_per_minute); // Free plan
        $this->assertEquals(1000, $rateLimits->requests_per_hour);
        $this->assertEquals(10000, $rateLimits->requests_per_day);
    }

    public function test_platform_registration_requires_name(): void
    {
        $response = $this->postJson('/api/platforms/register', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(422);
    }

    public function test_platform_login_with_valid_api_key(): void
    {
        // First register a platform
        $registerResponse = $this->postJson('/api/platforms/register', [
            'name' => 'Test Platform',
        ]);

        $apiKey = $registerResponse->json('platform.api_key');

        // Login with API key
        $response = $this->postJson('/api/platforms/login', [
            'api_key' => $apiKey,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'platform' => [
                    'id',
                    'name',
                    'plan',
                    'status',
                ],
            ]);

        $this->assertTrue($response->json('success'));
        $this->assertEquals('Test Platform', $response->json('platform.name'));
    }

    public function test_platform_login_with_invalid_api_key(): void
    {
        $response = $this->postJson('/api/platforms/login', [
            'api_key' => 'invalid_key',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'error' => 'Invalid API key',
            ]);
    }

    public function test_platform_login_requires_api_key(): void
    {
        $response = $this->postJson('/api/platforms/login', []);

        $response->assertStatus(422);
    }
}

