<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_voice_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->string('user_identifier'); // Can be user ID, email, or any unique identifier from the platform
            $table->boolean('voice_actions_enabled')->default(true);
            $table->string('locale')->default('en-US');
            $table->json('preferences')->nullable(); // For future custom preferences
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
            
            // Unique constraint: one setting per user per platform
            $table->unique(['platform_id', 'user_identifier']);
            $table->index('platform_id');
            $table->index('user_identifier');
            $table->index('voice_actions_enabled');
            
            // Foreign key constraint (if platforms table exists)
            // $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_voice_settings');
    }
};

