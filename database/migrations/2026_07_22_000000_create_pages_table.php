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
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->string('section')->default('General Pages');
                $table->string('label');
                $table->string('route_name')->unique();
                $table->string('url_path');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->text('keywords')->nullable();
                $table->string('status')->default('published');
                $table->string('view_name')->nullable();
                $table->string('social_image')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
