<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');        // "Sustainable Livestock Feed Alternatives"
            $table->string('status');       // "Ongoing", "Completed"

            // Duration Logic
            $table->string('start_date');   // "2023"
            $table->string('end_date')->nullable(); // "2023"
            $table->boolean('is_current')->default(false); // If true, shows "Present"

            $table->text('description');    // "Investigating alternative feed..."

            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_projects');
    }
};
