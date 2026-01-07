<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('philosophy_settings', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->string('quote_author')->default('MD Imranuzzaman');
            $table->string('vision_title')->default('Vision for the Future');
            $table->longText('vision_description');
            $table->json('core_values')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('philosophy_settings');
    }
};
