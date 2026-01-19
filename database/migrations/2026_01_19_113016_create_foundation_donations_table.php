<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('foundation_donations', function (Blueprint $table) {
        $table->id();
        $table->string('name');         // e.g., "Credit/Debit Card"
        $table->string('description');  // e.g., "Secure payment via Stripe"
        $table->string('provider_id');  // e.g., "stripe", "paypal"
        $table->enum('status', ['active', 'coming_soon', 'inactive'])->default('coming_soon');
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foundation_donations');
    }
};
