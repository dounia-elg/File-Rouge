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
        Schema::table('workshops', function (Blueprint $table) {
            // Make date column nullable to allow it to work with our simplified form
            if (Schema::hasColumn('workshops', 'date')) {
                $table->timestamp('date')->nullable()->change();
            } else {
                $table->timestamp('date')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            // No need to reverse as we're just making a column nullable
        });
    }
};
