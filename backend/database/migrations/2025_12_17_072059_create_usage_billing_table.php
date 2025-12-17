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
        Schema::create('usage_billing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->string('month', 7); // Y-m format
            $table->integer('base_subscription_amount')->default(0); // Amount në cents
            $table->integer('usage_count')->default(0);
            $table->integer('included_usage')->default(0); // Included usage në plan
            $table->integer('overage_count')->default(0); // Komanda mbi limit
            $table->decimal('overage_rate', 8, 4)->default(0.01);
            $table->integer('overage_amount')->default(0); // Amount në cents
            $table->integer('total_amount')->default(0); // Total në cents
            $table->string('stripe_invoice_id')->nullable();
            $table->enum('status', ['pending', 'calculated', 'invoiced', 'paid'])->default('pending');
            $table->timestamp('calculated_at')->nullable();
            $table->timestamp('invoiced_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            $table->unique(['platform_id', 'month']);
            $table->index('platform_id');
            $table->index('month');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usage_billing');
    }
};
