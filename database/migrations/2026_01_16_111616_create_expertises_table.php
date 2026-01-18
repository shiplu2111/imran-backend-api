<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expertises', function (Blueprint $table) {
            $table->id();
            $table->string('title');       // e.g., "Veterinary Pharmacology"
            $table->text('description');   // e.g., "Drug efficacy studies..."
            $table->string('icon')->nullable(); // e.g., "Pill", "Leaf", "Shield"
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expertises');
    }
};
