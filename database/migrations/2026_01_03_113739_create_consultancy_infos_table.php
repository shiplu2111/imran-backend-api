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
        Schema::create('consultancy_infos', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // e.g., 'ruminants', 'poultry'
            $table->string('page_heading');
            $table->text('sub_heading')->nullable();
            $table->json('sections')->nullable(); // Stores the array of objects
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultancy_infos');
    }
};
