<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserVoiceSettingsController extends Controller
{
    /**
     * Get voice settings for a specific user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserSettings(Request $request)
    {
        $request->validate([
            'user_identifier' => 'required|string|max:255',
        ]);

        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'error' => 'API key required'
            ], 401);
        }

        $platform = $this->verifyApiKey($apiKey);
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $settings = DB::table('user_voice_settings')
            ->where('platform_id', $platform['id'])
            ->where('user_identifier', $request->user_identifier)
            ->first();

        // Default settings if user doesn't have any
        if (!$settings) {
            return response()->json([
                'success' => true,
                'settings' => [
                    'voice_actions_enabled' => true,
                    'locale' => 'en-US',
                    'preferences' => null,
                ],
                'is_new' => true
            ]);
        }

        return response()->json([
            'success' => true,
            'settings' => [
                'voice_actions_enabled' => (bool) $settings->voice_actions_enabled,
                'locale' => $settings->locale ?? 'en-US',
                'preferences' => $settings->preferences ? json_decode($settings->preferences, true) : null,
            ],
            'is_new' => false
        ]);
    }

    /**
     * Update voice settings for a specific user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserSettings(Request $request)
    {
        $request->validate([
            'user_identifier' => 'required|string|max:255',
            'voice_actions_enabled' => 'sometimes|boolean',
            'locale' => 'sometimes|string|max:10',
            'preferences' => 'sometimes|array',
        ]);

        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'error' => 'API key required'
            ], 401);
        }

        $platform = $this->verifyApiKey($apiKey);
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $updateData = [
            'updated_at' => now(),
        ];

        if ($request->has('voice_actions_enabled')) {
            $updateData['voice_actions_enabled'] = $request->voice_actions_enabled;
        }

        if ($request->has('locale')) {
            $updateData['locale'] = $request->locale;
        }

        if ($request->has('preferences')) {
            $updateData['preferences'] = json_encode($request->preferences);
        }

        // Check if settings exist
        $existing = DB::table('user_voice_settings')
            ->where('platform_id', $platform['id'])
            ->where('user_identifier', $request->user_identifier)
            ->first();

        if ($existing) {
            // Update existing
            DB::table('user_voice_settings')
                ->where('platform_id', $platform['id'])
                ->where('user_identifier', $request->user_identifier)
                ->update($updateData);
        } else {
            // Create new
            $updateData['platform_id'] = $platform['id'];
            $updateData['user_identifier'] = $request->user_identifier;
            $updateData['voice_actions_enabled'] = $request->voice_actions_enabled ?? true;
            $updateData['locale'] = $request->locale ?? 'en-US';
            $updateData['created_at'] = now();
            
            DB::table('user_voice_settings')->insert($updateData);
        }

        $updated = DB::table('user_voice_settings')
            ->where('platform_id', $platform['id'])
            ->where('user_identifier', $request->user_identifier)
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'User settings updated successfully',
            'settings' => [
                'voice_actions_enabled' => (bool) $updated->voice_actions_enabled,
                'locale' => $updated->locale,
                'preferences' => $updated->preferences ? json_decode($updated->preferences, true) : null,
            ]
        ]);
    }

    /**
     * Check if voice actions is enabled for a user (lightweight check)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkUserEnabled(Request $request)
    {
        $request->validate([
            'user_identifier' => 'required|string|max:255',
        ]);

        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'error' => 'API key required'
            ], 401);
        }

        $platform = $this->verifyApiKey($apiKey);
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        // Check platform-level setting first
        $platformData = DB::table('platforms')
            ->where('id', $platform['id'])
            ->first();

        if (!$platformData || !($platformData->voice_actions_enabled ?? true)) {
            return response()->json([
                'success' => true,
                'enabled' => false,
                'reason' => 'platform_disabled'
            ]);
        }

        // Check user-level setting
        $userSetting = DB::table('user_voice_settings')
            ->where('platform_id', $platform['id'])
            ->where('user_identifier', $request->user_identifier)
            ->value('voice_actions_enabled');

        // Default to true if no setting exists
        $enabled = $userSetting !== null ? (bool) $userSetting : true;

        return response()->json([
            'success' => true,
            'enabled' => $enabled,
            'reason' => $enabled ? 'enabled' : 'user_disabled'
        ]);
    }

    /**
     * Verify API key (reuse from PlatformController logic)
     */
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

