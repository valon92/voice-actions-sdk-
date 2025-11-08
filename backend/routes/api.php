<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\CommandController;

Route::get('/platforms', function () {
    return response()->json([
        'success' => true,
        'message' => 'Voice Actions SDK API is running successfully!',
        'available_endpoints' => [
            'POST /api/platforms/register' => 'Register new platform',
            'POST /api/platforms/login' => 'Login with API key',
            'GET /api/usage/stats' => 'Get usage statistics (requires API key)',
            'POST /api/usage/track' => 'Track SDK usage (requires API key)',
            'GET /api/commands' => 'Get voice commands (requires API key)',
        ]
    ]);
});

// Platform routes
Route::post('/platforms/register', [PlatformController::class, 'register']);
Route::post('/platforms/login', [PlatformController::class, 'login']);
Route::get('/platforms/{id}', [PlatformController::class, 'show'])->middleware('api.key');

// Demo route (no API key required)
Route::get('/commands/demo', [CommandController::class, 'demo']);

// Usage routes (require API key)
Route::middleware('api.key')->group(function () {
    Route::get('/usage/stats', [UsageController::class, 'getStats']);
    Route::post('/usage/track', [UsageController::class, 'track']);
    Route::get('/commands', [CommandController::class, 'index']);
});

