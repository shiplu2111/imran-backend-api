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
    Schema::create('videos', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');

        // Category Relationship
        $table->unsignedBigInteger('category_id');

        $table->date('date');
        $table->string('video_url');     // YouTube/Vimeo link or file path
        $table->string('duration');      // e.g., "10:05"
        $table->json('tags')->nullable();
        $table->string('status')->default('published'); // draft, published, archived
        $table->timestamps();

        // Foreign Key
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
