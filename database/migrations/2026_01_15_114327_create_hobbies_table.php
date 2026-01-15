<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hobbies', function (Blueprint $table) {
            $table->id();
            $table->string('name');        // e.g., "Photography"
            $table->text('description');   // e.g., "Capturing moments..."
            $table->string('image')->nullable(); // Stores file path
            $table->integer('sort_order')->default(0); // To arrange the grid
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hobbies');
    }
};
