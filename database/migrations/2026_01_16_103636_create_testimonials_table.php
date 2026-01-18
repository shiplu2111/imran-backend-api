<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            $table->string('name');          // "Dr. Sarah Johnson"
            $table->string('position');      // "Professor of Veterinary Medicine"
            $table->string('institution');   // "University of Missouri"
            $table->text('message');         // "Imranuzzaman's research on..."

            $table->string('image')->nullable(); // Optional headshot
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
