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
        // Skip this migration since we now include these columns in the base workshops table
        if (Schema::hasTable('workshops') && !Schema::hasColumn('workshops', 'views')) {
            Schema::table('workshops', function (Blueprint $table) {
                $table->integer('views')->default(0);
                $table->integer('likes')->default(0);
                $table->integer('duration')->comment('Duration in minutes')->after('end_time')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('workshops') && Schema::hasColumn('workshops', 'views')) {
            Schema::table('workshops', function (Blueprint $table) {
                $table->dropColumn(['views', 'likes', 'duration']);
            });
        }
    }
};
