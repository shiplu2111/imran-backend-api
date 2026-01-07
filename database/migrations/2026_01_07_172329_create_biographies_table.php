<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biographies', function (Blueprint $table) {
            $table->id();

            // Header Info
            $table->string('name')->default('MD Imranuzzaman');
            $table->string('headline')->nullable(); // "My journey from..."
            $table->text('short_bio')->nullable();  // "Dedicated researcher..."
            $table->longText('full_bio')->nullable();   // "Born and raised..."

            // Personal Details
            $table->string('current_location')->nullable();
            $table->string('hometown')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();

            // Profile Photo
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biographies');
    }
};
