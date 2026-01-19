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
    Schema::create('career_journeys', function (Blueprint $table) {
        $table->id();
        $table->string('icon')->nullable();
        $table->string('year');         // e.g., "2024" or "2020-2022"
        $table->string('title');        // e.g., "Graduate Research Excellence Award"
        $table->string('description')->nullable(); // e.g., "Recognized for..."
        $table->integer('sort_order')->default(0); // To keep them in order
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_journeys');
    }
};
