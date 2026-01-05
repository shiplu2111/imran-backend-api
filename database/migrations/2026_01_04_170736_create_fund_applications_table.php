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
        Schema::create('fund_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('organization')->nullable(); // Optional

            // "Research Grant", "Academic Scholarship", etc.
            $table->string('support_type');
            $table->string('research_area')->nullable(); // Optional for research grants
            $table->decimal('amount_requested', 10, 2)->nullable(); // Optional money field
            $table->string('purpose'); // Short purpose
            $table->text('proposal_summary'); // Long description
            $table->string('country')->nullable();
            $table->string('project_title')->nullable();
            // File path for PDF/DOC
            $table->string('document')->nullable();

            // Status Management
            $table->string('status')->default('pending'); // pending, approved, rejected

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_applications');
    }
};
