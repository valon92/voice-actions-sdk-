<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usage_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
            $table->string('platform_name');
            $table->string('session_id');
            $table->string('event');
            $table->json('data')->nullable();
            $table->timestamp('timestamp');
            $table->timestamps();
            
            $table->index('platform_id');
            $table->index('platform_name');
            $table->index('session_id');
            $table->index('event');
            $table->index('timestamp');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usage_tracking');
    }
};

