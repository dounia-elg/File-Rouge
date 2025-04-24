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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('video_link');
            $table->string('thumbnail_image')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('duration')->comment('Duration in minutes')->default(0);
            $table->string('skill_level')->default('beginner'); // beginner, intermediate, advanced
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
}; 