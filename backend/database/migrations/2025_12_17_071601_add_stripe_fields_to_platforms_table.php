<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->string('stripe_customer_id')->nullable()->unique()->after('api_key_hash');
            $table->enum('subscription_status', ['active', 'canceled', 'past_due', 'trialing', 'incomplete', 'none'])->default('none')->after('status');
            $table->timestamp('trial_ends_at')->nullable()->after('last_used_at');
            
            $table->index('stripe_customer_id');
            $table->index('subscription_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->dropColumn(['stripe_customer_id', 'subscription_status', 'trial_ends_at']);
        });
    }
};
