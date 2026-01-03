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
    Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');

        // Link to Categories Table (assuming you used the single table approach)
        $table->unsignedBigInteger('category_id');

        $table->date('date');
        $table->string('image_url'); // Path to the file
        $table->json('tags')->nullable(); // Store tags as ["Nature", "HD"]
        $table->string('status')->default('published'); // draft, published, archived
        $table->timestamps();

        // Foreign Key Constraint (Optional but recommended)
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
