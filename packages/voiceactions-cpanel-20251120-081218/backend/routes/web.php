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

