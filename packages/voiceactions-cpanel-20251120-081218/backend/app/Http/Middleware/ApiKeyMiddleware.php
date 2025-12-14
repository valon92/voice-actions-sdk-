<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'error' => 'API key required. Provide it in Authorization header as Bearer token or X-API-Key header.'
            ], 401);
        }

        // Verify API key using hash
        $platforms = DB::table('platforms')
            ->where('status', 'active')
            ->select('id', 'name', 'api_key', 'api_key_hash', 'plan', 'status')
            ->get();

        $platform = null;
        foreach ($platforms as $p) {
            if (Hash::check($apiKey, $p->api_key_hash)) {
                $platform = $p;
                break;
            }
        }

        // Fallback: check plain text api_key
        if (!$platform) {
            $platform = DB::table('platforms')
                ->where('api_key', $apiKey)
                ->where('status', 'active')
                ->first();
        }

        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid or inactive API key'
            ], 401);
        }

        // Attach platform info to request
        $request->merge([
            'api_platform_id' => $platform->id,
            'api_platform_plan' => $platform->plan ?? 'free'
        ]);

        return $next($request);
    }
}

