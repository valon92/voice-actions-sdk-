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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
            $table->string('type')->default('info'); // 'info', 'update', 'feature', 'warning', 'success'
            $table->string('title');
            $table->text('message');
            $table->text('action_url')->nullable(); // Optional URL for action button
            $table->string('action_text')->nullable(); // Optional text for action button
            $table->boolean('is_active')->default(true);
            $table->boolean('is_dismissible')->default(true); // Can user dismiss it?
            $table->timestamp('starts_at')->nullable(); // When to start showing
            $table->timestamp('ends_at')->nullable(); // When to stop showing
            $table->integer('priority')->default(0); // Higher priority = shown first
            $table->json('target_audience')->nullable(); // ['all'] or specific user IDs
            $table->integer('view_count')->default(0); // Track how many times shown
            $table->timestamps();

            $table->index('platform_id');
            $table->index(['platform_id', 'is_active', 'priority']);
            $table->index(['platform_id', 'starts_at', 'ends_at']);
        });

        // Table to track which users have seen/dismissed notifications
        Schema::create('notification_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('notifications')->onDelete('cascade');
            $table->string('user_identifier')->nullable(); // User ID from platform
            $table->string('session_id')->nullable(); // Session ID for anonymous users
            $table->boolean('is_dismissed')->default(false);
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamps();

            $table->unique(['notification_id', 'user_identifier', 'session_id']);
            $table->index('notification_id');
            $table->index('user_identifier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_views');
        Schema::dropIfExists('notifications');
    }
};

