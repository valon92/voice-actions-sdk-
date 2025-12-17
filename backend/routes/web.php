<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Voice Actions SDK API',
        'version' => '1.0.0',
        'docs' => '/api/platforms'
    ]);
});

// SDK CDN Endpoint - Serve SDK files
Route::get('/sdk/{file}', function ($file) {
    $allowedFiles = [
        'voice-actions-sdk.min.js',
        'voice-actions-sdk.min.js.map',
        'voice-actions-sdk.js',
        'voice-actions-sdk.js.map',
        'voice-actions-sdk.esm.js',
        'voice-actions-sdk.esm.js.map',
    ];
    
    if (!in_array($file, $allowedFiles)) {
        return response()->json(['error' => 'File not found'], 404);
    }
    
    // Try to serve from frontend public directory first
    $frontendPath = base_path('../frontend/public/sdk/' . $file);
    if (file_exists($frontendPath)) {
        return response()->file($frontendPath, [
            'Content-Type' => str_ends_with($file, '.map') ? 'application/json' : 'application/javascript',
            'Cache-Control' => 'public, max-age=31536000', // 1 year cache
            'Access-Control-Allow-Origin' => '*', // Allow CORS
        ]);
    }
    
    // Fallback to SDK dist directory
    $sdkPath = base_path('../sdk/dist/' . $file);
    if (file_exists($sdkPath)) {
        return response()->file($sdkPath, [
            'Content-Type' => str_ends_with($file, '.map') ? 'application/json' : 'application/javascript',
            'Cache-Control' => 'public, max-age=31536000',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }
    
    return response()->json(['error' => 'File not found'], 404);
})->where('file', '.*');

