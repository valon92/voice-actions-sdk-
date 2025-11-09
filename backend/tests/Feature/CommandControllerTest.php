<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CommandControllerTest extends TestCase
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

    public function test_demo_endpoint_returns_commands_without_api_key(): void
    {
        $response = $this->getJson('/api/commands/demo?locale=en-US&platform_name=demo');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'commands',
                'platform' => [
                    'name',
                    'plan',
                ],
                'locale',
            ]);

        $this->assertTrue($response->json('success'));
        $this->assertEquals('demo', $response->json('platform.name'));
        $this->assertIsArray($response->json('commands'));
        $this->assertGreaterThan(0, count($response->json('commands')));
    }

    public function test_demo_endpoint_accepts_different_locales(): void
    {
        $locales = ['en-US', 'sq-AL', 'es-ES', 'fr-FR'];

        foreach ($locales as $locale) {
            $response = $this->getJson("/api/commands/demo?locale={$locale}");

            $response->assertStatus(200);
            $this->assertEquals($locale, $response->json('locale'));
            $this->assertIsArray($response->json('commands'));
        }
    }

    public function test_commands_endpoint_requires_api_key(): void
    {
        $response = $this->getJson('/api/commands?locale=en-US');

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
            ]);
    }

    public function test_commands_endpoint_returns_commands_with_valid_api_key(): void
    {
        $platform = $this->createPlatformWithApiKey();

        $response = $this->getJson('/api/commands?locale=en-US&platform_name=test', [
            'Authorization' => 'Bearer ' . $platform['api_key'],
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'commands',
                'platform' => [
                    'id',
                    'name',
                    'plan',
                ],
                'locale',
            ]);

        $this->assertTrue($response->json('success'));
        $this->assertIsArray($response->json('commands'));
    }

    public function test_commands_endpoint_returns_commands_with_x_api_key_header(): void
    {
        $platform = $this->createPlatformWithApiKey();

        $response = $this->getJson('/api/commands?locale=en-US', [
            'X-API-Key' => $platform['api_key'],
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response->json('success'));
    }

    public function test_commands_endpoint_returns_commands_for_different_locales(): void
    {
        $platform = $this->createPlatformWithApiKey();

        $locales = ['en-US', 'sq-AL', 'es-ES', 'fr-FR'];

        foreach ($locales as $locale) {
            $response = $this->getJson("/api/commands?locale={$locale}", [
                'X-API-Key' => $platform['api_key'],
            ]);

            $response->assertStatus(200);
            $this->assertEquals($locale, $response->json('locale'));
            $this->assertIsArray($response->json('commands'));
        }
    }
}

