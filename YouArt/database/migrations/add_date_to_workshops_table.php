<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create a temporary table with the desired structure
        Schema::create('workshops_new', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('video_link');
            $table->string('skill_level');
            $table->timestamps();
        });

        // Copy data from existing table to the new one, if the old table exists
        if (Schema::hasTable('workshops')) {
            DB::statement('INSERT INTO workshops_new (id, title, description, video_link, skill_level, created_at, updated_at)
                SELECT id, title, description, video_link, skill_level, created_at, updated_at 
                FROM workshops');
            
            // Drop the old table
            Schema::drop('workshops');
            
            // Rename the new table to the original name
            Schema::rename('workshops_new', 'workshops');
        } else {
            // If the workshops table doesn't exist, rename the new table
            Schema::rename('workshops_new', 'workshops');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Since we're fundamentally changing the table structure, 
        // there's no perfect way to reverse this migration.
        // The best we can do is recreate the table with common columns.
        Schema::table('workshops', function (Blueprint $table) {
            // We can't really roll back completely, as we would need to know
            // the exact previous structure
        });
    }
}; 