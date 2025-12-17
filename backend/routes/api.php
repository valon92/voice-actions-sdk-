<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\UserVoiceSettingsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UsageBillingController;

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

// Settings routes (require API key)
Route::middleware(['api.key'])->group(function () {
    Route::get('/platforms/settings', [PlatformController::class, 'getSettings']);
    Route::put('/platforms/settings', [PlatformController::class, 'updateSettings']);
    
    // User-level voice settings
    Route::get('/user-voice-settings', [UserVoiceSettingsController::class, 'getUserSettings']);
    Route::put('/user-voice-settings', [UserVoiceSettingsController::class, 'updateUserSettings']);
    Route::get('/user-voice-settings/check', [UserVoiceSettingsController::class, 'checkUserEnabled']);
});

// Demo route (no API key required)
Route::get('/commands/demo', [CommandController::class, 'demo']);

// Usage routes (require API key, rate limiting, and usage limits check)
Route::middleware(['api.key', 'rate.limit', 'usage.limits'])->group(function () {
    Route::get('/usage/stats', [UsageController::class, 'getStats']);
    Route::post('/usage/track', [UsageController::class, 'track']);
    Route::get('/commands', [CommandController::class, 'index']);
});

// Usage billing routes (require API key)
Route::middleware(['api.key'])->group(function () {
    Route::get('/usage/current', [UsageBillingController::class, 'getCurrentUsage']);
    Route::get('/usage/billing-history', [UsageBillingController::class, 'getBillingHistory']);
});

// Payment routes
Route::post('/payment/checkout', [PaymentController::class, 'createCheckoutSession']);
Route::post('/payment/webhook', [PaymentController::class, 'handleWebhook']); // No middleware - Stripe verifies signature

// Subscription routes (require API key)
Route::middleware(['api.key'])->group(function () {
    Route::get('/subscription/current', [SubscriptionController::class, 'getCurrent']);
    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancel']);
    Route::post('/subscription/resume', [SubscriptionController::class, 'resume']);
    Route::get('/subscription/history', [SubscriptionController::class, 'getHistory']);
    Route::get('/payment-methods', [PaymentController::class, 'getPaymentMethods']);
});

// Invoice routes (require API key)
Route::middleware(['api.key'])->group(function () {
    Route::get('/invoices', [InvoiceController::class, 'list']);
    Route::get('/invoices/{id}', [InvoiceController::class, 'get']);
    Route::get('/invoices/{id}/download', [InvoiceController::class, 'download']);
});

