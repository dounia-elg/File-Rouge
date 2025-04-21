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
            $table->integer('views')->default(0)->after('image_path');
            $table->integer('likes')->default(0)->after('views');
            $table->string('duration')->nullable()->after('end_time');
            $table->string('video_link')->nullable()->after('image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('views');
            $table->dropColumn('likes');
            $table->dropColumn('duration');
            $table->dropColumn('video_link');
        });
    }
};
