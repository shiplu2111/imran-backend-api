<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('title');
            $table->string('author'); // "Writed by"
            $table->text('description'); // Short Description
            $table->integer('published_year');

            // Categorization
            $table->string('type'); // 'Inspirational', 'Historic', 'Religious'

            // Files
            $table->string('thumbnail')->nullable(); // Image path
            $table->string('pdf')->nullable();       // PDF file path

            // Stats & Status
            $table->unsignedBigInteger('read_count')->default(0);      // How many viewed details
            $table->unsignedBigInteger('download_count')->default(0);  // How many downloaded PDF
            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
