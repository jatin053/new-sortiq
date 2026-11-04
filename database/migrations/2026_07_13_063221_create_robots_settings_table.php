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
        Schema::create('robots_settings', function (Blueprint $table) {
            $table->id();
            $table->string('crawling_mode')->default('production');
            $table->boolean('allow_frontend')->default(true);
            $table->boolean('block_backend')->default(true);
            $table->boolean('block_api')->default(true);
            $table->boolean('block_login')->default(true);
            $table->boolean('include_sitemap')->default(true);
            $table->boolean('block_images')->default(false);
            $table->boolean('block_css')->default(false);
            $table->boolean('block_js')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robots_settings');
    }
};
