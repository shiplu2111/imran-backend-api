<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();

            $table->string('role');         // e.g. "Graduate Research Assistant"
            $table->string('organization'); // e.g. "Lincoln University of Missouri"
            $table->string('location');     // e.g. "Jefferson City, Missouri, USA"

            $table->string('start_date');   // "2023"
            $table->string('end_date')->nullable(); // "2023" or NULL
            $table->boolean('is_current')->default(false); // If true, displays "Present"

            $table->text('description');    // "Conducting research on..."

            // Status Control
            $table->boolean('is_published')->default(true);

            $table->integer('sort_order')->default(0); // Optional: to reorder manually
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
