<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PlatformController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'expected_usage' => 'nullable|integer|min:0',
        ]);

        $apiKey = 'va_' . Str::random(32);
        $apiKeyHash = Hash::make($apiKey);

        $platform = DB::table('platforms')->insertGetId([
            'name' => $request->name,
            'api_key' => $apiKey,
            'api_key_hash' => $apiKeyHash,
            'email' => $request->email,
            'website' => $request->website,
            'plan' => $this->determinePlan($request->expected_usage ?? 0),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create rate limits
        DB::table('api_rate_limits')->insert([
            'platform_id' => $platform,
            'requests_per_minute' => 1000,
            'requests_per_hour' => 10000,
            'requests_per_day' => 100000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $platformData = DB::table('platforms')->where('id', $platform)->first();

        return response()->json([
            'success' => true,
            'message' => 'Platform registered successfully',
            'platform' => [
                'id' => $platformData->id,
                'name' => $platformData->name,
                'api_key' => $apiKey, // Only returned once
                'plan' => $platformData->plan,
                'status' => $platformData->status,
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'api_key' => 'required|string',
        ]);

        $platform = $this->verifyApiKey($request->api_key);

        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $platformData = DB::table('platforms')->where('id', $platform['id'])->first();

        return response()->json([
            'success' => true,
            'platform' => [
                'id' => $platformData->id,
                'name' => $platformData->name,
                'plan' => $platformData->plan,
                'status' => $platformData->status,
            ]
        ]);
    }

    public function show($id)
    {
        $platform = DB::table('platforms')->where('id', $id)->first();

        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Platform not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'platform' => [
                'id' => $platform->id,
                'name' => $platform->name,
                'plan' => $platform->plan,
                'status' => $platform->status,
            ]
        ]);
    }

    private function determinePlan($expectedUsage)
    {
        if ($expectedUsage >= 1000000) {
            return 'enterprise';
        } elseif ($expectedUsage >= 10000) {
            return 'pro';
        }
        return 'free';
    }

    private function verifyApiKey($apiKey)
    {
        $platforms = DB::table('platforms')
            ->where('status', 'active')
            ->select('id', 'api_key', 'api_key_hash', 'plan')
            ->get();

        foreach ($platforms as $platform) {
            if (Hash::check($apiKey, $platform->api_key_hash)) {
                return [
                    'id' => $platform->id,
                    'plan' => $platform->plan ?? 'free'
                ];
            }
        }

        // Fallback: check plain text api_key
        $platform = DB::table('platforms')
            ->where('api_key', $apiKey)
            ->where('status', 'active')
            ->first();

        if ($platform) {
            return [
                'id' => $platform->id,
                'plan' => $platform->plan ?? 'free'
            ];
        }

        return null;
    }
}

