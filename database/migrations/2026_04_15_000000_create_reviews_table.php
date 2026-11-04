<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('platform')->nullable();
            $table->string('position')->nullable();
            $table->unsignedTinyInteger('rating')->default(5);
            $table->date('published_at')->nullable();
            $table->string('status')->default('draft');
            $table->text('content');
            $table->string('summary')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
