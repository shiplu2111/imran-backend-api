<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');      // e.g. "Lincoln University of Missouri"
            $table->string('category');  // e.g. "Academic", "Government"
            $table->string('logo')->nullable(); // Path to image file
            $table->string('website')->nullable(); // Optional link
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
