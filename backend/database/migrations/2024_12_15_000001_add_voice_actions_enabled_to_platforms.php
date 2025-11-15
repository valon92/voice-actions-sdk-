<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Add voice_actions_enabled column to platforms table
        Schema::table('platforms', function (Blueprint $table) {
            $table->boolean('voice_actions_enabled')->default(true)->after('status');
        });

        // Update existing platforms to have voice_actions_enabled = true by default
        DB::table('platforms')->update(['voice_actions_enabled' => true]);
    }

    public function down(): void
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->dropColumn('voice_actions_enabled');
        });
    }
};

