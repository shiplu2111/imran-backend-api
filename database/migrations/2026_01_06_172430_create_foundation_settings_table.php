<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foundation_settings', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name')->default('My Foundation');
            $table->string('tagline')->nullable();
            $table->string('year_established')->nullable();
            $table->string('registration_number')->nullable();

            // Mission & Vision
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();

            // Contact
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            // What We Do (Services List) - Stored as JSON
            $table->json('services')->nullable();

            // Call to Action
            $table->text('cta_text')->nullable();

            // Media
            $table->string('logo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foundation_settings');
    }
};
