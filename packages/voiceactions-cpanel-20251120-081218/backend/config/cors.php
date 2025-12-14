<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
    'allowed_origins' => array_filter([
        env('FRONTEND_URL', 'http://localhost:5173'),
        env('APP_URL', 'http://localhost:8000'),
        // Production domains
        'https://voiceactions.dev',
        'https://www.voiceactions.dev',
        // Allow all origins in local environment only
        env('APP_ENV') === 'local' ? '*' : null,
    ]),
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['Content-Type', 'Authorization', 'X-API-Key', 'X-Requested-With', 'Accept'],
    'exposed_headers' => ['X-RateLimit-Limit-Minute', 'X-RateLimit-Remaining-Minute', 'X-RateLimit-Limit-Hour', 'X-RateLimit-Remaining-Hour', 'X-RateLimit-Limit-Day', 'X-RateLimit-Remaining-Day'],
    'max_age' => 86400, // 24 hours
    'supports_credentials' => true,
];
