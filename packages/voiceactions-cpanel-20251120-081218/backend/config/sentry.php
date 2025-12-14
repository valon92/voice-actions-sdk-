<?php

return [
    'dsn' => env('SENTRY_LARAVEL_DSN', env('SENTRY_DSN')),

    // The release version of your application
    // Example with dynamic git hash: 'release' => trim(exec('git --git-dir ' . base_path('.git') . ' log -1 --format=%H')),
    'release' => env('SENTRY_RELEASE'),

    // When left empty or `null` the Laravel environment will be used
    'environment' => env('SENTRY_ENVIRONMENT', env('APP_ENV', 'production')),

    // @see: https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/#traces-sample-rate
    'traces_sample_rate' => env('SENTRY_TRACES_SAMPLE_RATE', 0.0),

    // @see: https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/#profiles-sample-rate
    'profiles_sample_rate' => env('SENTRY_PROFILES_SAMPLE_RATE', 0.0),

    // @see: https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/#send-default-pii
    'send_default_pii' => env('SENTRY_SEND_DEFAULT_PII', false),

    // @see: https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/#ignore-exceptions
    'ignore_exceptions' => [
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        \Illuminate\Validation\ValidationException::class,
    ],

    // @see: https://docs.sentry.io/platforms/php/guides/laravel/configuration/options/#ignore-transactions
    'ignore_transactions' => [
        // Ignore health check endpoints
        'GET /health',
        'GET /api/health',
    ],
];

