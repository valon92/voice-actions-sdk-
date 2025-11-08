<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('api_key')->unique();
            $table->string('api_key_hash')->unique();
            $table->enum('plan', ['free', 'pro', 'enterprise'])->default('free');
            $table->enum('status', ['active', 'suspended', 'inactive'])->default('active');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->json('settings')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
            
            $table->index('api_key_hash');
            $table->index('status');
            $table->index('plan');
            $table->index('last_used_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('platforms');
    }
};

