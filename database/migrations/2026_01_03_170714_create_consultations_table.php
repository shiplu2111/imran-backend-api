<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->string('type'); // Ruminants or Poultry
            $table->text('message');
            $table->date('date')->nullable(); // Preferred date of consultation

            // Status Fields
            $table->string('payment_status')->default('unpaid'); // unpaid, paid
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
