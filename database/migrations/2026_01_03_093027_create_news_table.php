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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            // Relationship to Categories table
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');

            $table->string('headline');
            $table->string('source')->nullable(); // e.g., "Bangladesh Daily Star"
            $table->date('date');
            $table->text('excerpt'); // Short description
            $table->string('external_link')->nullable(); // Standard DB naming (snake_case)
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
