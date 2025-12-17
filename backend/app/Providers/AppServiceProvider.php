<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Optimize SQLite për better performance
        if (config('database.default') === 'sqlite') {
            try {
                // Enable WAL mode për better concurrency
                DB::statement('PRAGMA journal_mode=WAL;');
                
                // Optimize synchronous mode (balance between safety and performance)
                DB::statement('PRAGMA synchronous=NORMAL;');
                
                // Increase cache size (10MB = 10000 pages)
                DB::statement('PRAGMA cache_size=10000;');
                
                // Enable foreign keys
                DB::statement('PRAGMA foreign_keys=ON;');
                
                // Optimize temp store (memory instead of disk)
                DB::statement('PRAGMA temp_store=MEMORY;');
                
                // Set page size (if not already set)
                // DB::statement('PRAGMA page_size=4096;');
            } catch (\Exception $e) {
                // Silent fail - SQLite might not be available
                \Log::warning('SQLite optimization failed: ' . $e->getMessage());
            }
        }
    }
}
