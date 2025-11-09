<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsageControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->createTables();
    }

    protected function tearDown(): void
    {
        DB::statement('DROP TABLE IF EXISTS usage_counters');
        DB::statement('DROP TABLE IF EXISTS usage_tracking');
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

        DB::statement('CREATE TABLE IF NOT EXISTS usage_tracking (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            platform_id INTEGER NOT NULL,
            platform_name VARCHAR(255),
            session_id VARCHAR(255),
            event VARCHAR(255) NOT NULL,
            data TEXT,
            timestamp DATETIME NOT NULL,
            created_at DATETIME,
            updated_at DATETIME
        )');

        DB::statement('CREATE TABLE IF NOT EXISTS usage_counters (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            platform_id INTEGER NOT NULL,
            platform_name VARCHAR(255),
            month VARCHAR(7) NOT NULL,
            count INTEGER DEFAULT 0,
            created_at DATETIME,
            updated_at DATETIME,
            UNIQUE(platform_id, platform_name, month)
        )');
    }

    private function createPlatformWithApiKey(): array
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

    public function test_get_stats_requires_api_key(): void
    {
        $response = $this->getJson('/api/usage/stats');

        $response->assertStatus(401);
    }

    public function test_get_stats_returns_zero_for_new_platform(): void
    {
        $platform = $this->createPlatformWithApiKey();

        $response = $this->getJson('/api/usage/stats', [
            'X-API-Key' => $platform['api_key'],
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'stats' => [
                    'total_commands',
                    'monthly_commands',
                    'last_30_days_commands',
                ],
            ]);

        $this->assertTrue($response->json('success'));
        $this->assertEquals(0, $response->json('stats.total_commands'));
        $this->assertEquals(0, $response->json('stats.monthly_commands'));
        $this->assertEquals(0, $response->json('stats.last_30_days_commands'));
    }

    public function test_track_usage_requires_api_key(): void
    {
        $response = $this->postJson('/api/usage/track', [
            'event' => 'command_executed',
        ]);

        $response->assertStatus(401);
    }

    public function test_track_usage_creates_tracking_record(): void
    {
        $platform = $this->createPlatformWithApiKey();

        $response = $this->postJson('/api/usage/track', [
            'event' => 'command_executed',
            'platform_name' => 'test',
            'session_id' => 'session123',
            'data' => ['command' => 'like'],
        ], [
            'X-API-Key' => $platform['api_key'],
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Usage tracked successfully.',
            ]);

        $tracking = DB::table('usage_tracking')
            ->where('platform_id', $platform['id'])
            ->first();

        $this->assertNotNull($tracking);
        $this->assertEquals('command_executed', $tracking->event);
    }

    public function test_track_command_executed_updates_counter(): void
    {
        $platform = $this->createPlatformWithApiKey();
        $month = now()->format('Y-m');

        $response = $this->postJson('/api/usage/track', [
            'event' => 'command_executed',
            'platform_name' => 'test',
        ], [
            'X-API-Key' => $platform['api_key'],
        ]);

        $response->assertStatus(200);

        $counter = DB::table('usage_counters')
            ->where('platform_id', $platform['id'])
            ->where('month', $month)
            ->first();

        $this->assertNotNull($counter);
        $this->assertEquals(1, $counter->count);
    }

    public function test_get_stats_returns_correct_counts_after_tracking(): void
    {
        $platform = $this->createPlatformWithApiKey();

        // Track some usage
        $this->postJson('/api/usage/track', [
            'event' => 'command_executed',
            'platform_name' => 'test',
        ], [
            'X-API-Key' => $platform['api_key'],
        ]);

        $this->postJson('/api/usage/track', [
            'event' => 'command_executed',
            'platform_name' => 'test',
        ], [
            'X-API-Key' => $platform['api_key'],
        ]);

        $response = $this->getJson('/api/usage/stats', [
            'X-API-Key' => $platform['api_key'],
        ]);

        $response->assertStatus(200);
        $this->assertEquals(2, $response->json('stats.monthly_commands'));
    }
}

