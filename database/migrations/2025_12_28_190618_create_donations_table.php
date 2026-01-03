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
        Schema::create('donations', function (Blueprint $table) {
           $table->id();
            $table->string('donor'); // Name of the donor
            $table->string('email');
            $table->decimal('amount', 10, 2); // Money format
            $table->string('method'); // Card, Bank, Mobile
            $table->date('date');
            $table->longText('notes')->nullable();
            $table->string('status')->default('pending'); // completed, pending, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
