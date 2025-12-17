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
            $table->integer('usage_limit')->default(9999)->after('plan'); // Default limit për free plan
            $table->integer('usage_current')->default(0)->after('usage_limit'); // Current usage për muajin
            $table->enum('billing_model', ['fixed', 'metered', 'hybrid'])->default('hybrid')->after('usage_current');
            $table->decimal('overage_rate', 8, 4)->default(0.01)->after('billing_model'); // $0.01 për komandë mbi limit
            $table->timestamp('usage_reset_at')->nullable()->after('overage_rate'); // Kur duhet të reset usage
            
            $table->index('usage_limit');
            $table->index('usage_current');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->dropColumn(['usage_limit', 'usage_current', 'billing_model', 'overage_rate', 'usage_reset_at']);
        });
    }
};
