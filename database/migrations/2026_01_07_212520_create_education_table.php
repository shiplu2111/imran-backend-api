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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('degree');         // e.g. "MS in Sustainable Agriculture"
            $table->string('field_of_study')->nullable(); // "Focus on sustainable farming..."
            $table->string('institution');    // "Lincoln University..."
            $table->string('location')->nullable();       // "Jefferson City..."
            $table->string('start_date');     // "2023" (String allows "Present" or "2018")
            $table->string('end_date')->nullable(); // "Present" or "2020"
            $table->boolean('currently_pursuing')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
