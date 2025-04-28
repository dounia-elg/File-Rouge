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

        // Add missing columns to the existing table instead of replacing it
        if (Schema::hasTable('workshops')) {
            // Add columns that might be needed
            if (!Schema::hasColumn('workshops', 'date')) {
                Schema::table('workshops', function (Blueprint $table) {
                    $table->timestamp('date')->nullable();
                });
            }
            
            // Remove all columns from the existing workshops table except the ones we want to keep
            Schema::table('workshops', function (Blueprint $table) {
                // Keep only these columns and drop the rest
                $columnsToKeep = ['id', 'title', 'description', 'video_link', 'skill_level', 'created_at', 'updated_at'];
                $columns = Schema::getColumnListing('workshops');
                
                foreach ($columns as $column) {
                    if (!in_array($column, $columnsToKeep)) {
                        try {
                            $table->dropColumn($column);
                        } catch (\Exception $e) {
                            // Column might not exist or be droppable, continue anyway
                        }
                    }
                }
            });
        } else {
            // If the workshops table doesn't exist, rename the new table
            Schema::rename('workshops_new', 'workshops');
        }
        
        // Clean up the temporary table if it still exists
        if (Schema::hasTable('workshops_new')) {
            Schema::dropIfExists('workshops_new');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to do anything in down method as we're just simplifying the table structure
    }
}; 