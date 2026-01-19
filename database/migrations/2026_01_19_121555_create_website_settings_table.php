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
    Schema::create('website_settings', function (Blueprint $table) {
        $table->id();
        $table->string('site_name')->default('My Website');

        // Logo Logic
        $table->enum('logo_type', ['text', 'image'])->default('text');
        $table->string('logo_text')->nullable(); // If type is text
        $table->string('logo_image')->nullable(); // If type is image (path)

        // Other Common Settings
        $table->string('primary_email')->nullable();
        $table->string('primary_phone')->nullable();
        $table->text('address')->nullable();
        $table->string('map_iframe_url')->nullable();
        $table->string('footer_text')->nullable();
        // Notification & Maintenance Settings
        $table->boolean('email_notifications')->default(true);
        $table->boolean('fund_applications_alerts')->default(true);
        $table->boolean('message_alerts')->default(true);
        $table->boolean('maintenance_mode')->default(false);
        $table->boolean('consultancy_alerts')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
