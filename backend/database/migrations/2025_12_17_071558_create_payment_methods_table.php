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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_id');
            $table->string('stripe_payment_method_id')->nullable()->unique();
            $table->enum('type', ['card', 'bank_account', 'sepa_debit'])->default('card');
            $table->string('last4')->nullable();
            $table->string('brand')->nullable(); // visa, mastercard, amex, etc.
            $table->integer('exp_month')->nullable();
            $table->integer('exp_year')->nullable();
            $table->string('country')->nullable();
            $table->boolean('is_default')->default(false);
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->foreign('platform_id')->references('id')->on('platforms')->onDelete('cascade');
            $table->index('platform_id');
            $table->index('stripe_payment_method_id');
            $table->index('is_default');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
