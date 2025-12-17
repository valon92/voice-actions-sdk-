<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add performance indexes për SQLite optimization
     */
    public function up(): void
    {
        // Only run për SQLite
        if (config('database.default') !== 'sqlite') {
            return;
        }

        // Composite index për usage_tracking - optimized për common queries
        // This helps with queries like: WHERE platform_id = X AND timestamp >= Y AND event = Z
        try {
            DB::statement('CREATE INDEX IF NOT EXISTS idx_usage_tracking_platform_timestamp_event ON usage_tracking(platform_id, timestamp, event);');
        } catch (\Exception $e) {
            // Index might already exist
        }

        // Index për monthly queries
        try {
            DB::statement('CREATE INDEX IF NOT EXISTS idx_usage_tracking_platform_created ON usage_tracking(platform_id, created_at);');
        } catch (\Exception $e) {
            // Index might already exist
        }

        // Composite index për subscriptions - për active subscriptions lookup
        try {
            DB::statement('CREATE INDEX IF NOT EXISTS idx_subscriptions_platform_status ON subscriptions(platform_id, status);');
        } catch (\Exception $e) {
            // Index might already exist
        }

        // Composite index për invoices - për billing queries
        try {
            DB::statement('CREATE INDEX IF NOT EXISTS idx_invoices_platform_status_created ON invoices(platform_id, status, created_at);');
        } catch (\Exception $e) {
            // Index might already exist
        }

        // Composite index për payments
        try {
            DB::statement('CREATE INDEX IF NOT EXISTS idx_payments_platform_status_created ON payments(platform_id, status, created_at);');
        } catch (\Exception $e) {
            // Index might already exist
        }

        // Composite index për usage_billing
        try {
            DB::statement('CREATE INDEX IF NOT EXISTS idx_usage_billing_platform_month_status ON usage_billing(platform_id, month, status);');
        } catch (\Exception $e) {
            // Index might already exist
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (config('database.default') !== 'sqlite') {
            return;
        }

        try {
            DB::statement('DROP INDEX IF EXISTS idx_usage_tracking_platform_timestamp_event;');
            DB::statement('DROP INDEX IF EXISTS idx_usage_tracking_platform_created;');
            DB::statement('DROP INDEX IF EXISTS idx_subscriptions_platform_status;');
            DB::statement('DROP INDEX IF EXISTS idx_invoices_platform_status_created;');
            DB::statement('DROP INDEX IF EXISTS idx_payments_platform_status_created;');
            DB::statement('DROP INDEX IF EXISTS idx_usage_billing_platform_month_status;');
        } catch (\Exception $e) {
            // Ignore errors on rollback
        }
    }
};

