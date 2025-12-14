<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usage_counters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')->constrained('platforms')->onDelete('cascade');
            $table->string('platform_name');
            $table->string('month', 7);
            $table->bigInteger('count')->default(0);
            $table->timestamps();
            
            $table->unique(['platform_id', 'platform_name', 'month']);
            $table->index('platform_id');
            $table->index('month');
            $table->index(['platform_id', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usage_counters');
    }
};

