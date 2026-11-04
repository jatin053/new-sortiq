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
        // Drop the temporary job_applications table to clean up
        Schema::dropIfExists('job_applications');

        // Create the fresher_hirings table
        Schema::create('fresher_hirings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 160);
            $table->string('country_code', 10)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('institute', 255)->nullable();
            $table->string('technology', 150)->nullable();
            $table->string('attachment', 255)->nullable(); // resume PDF path
            $table->string('url', 2048)->nullable(); // page source URL
            $table->string('status', 20)->default('unread');
            $table->timestamp('read_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fresher_hirings');
    }
};
