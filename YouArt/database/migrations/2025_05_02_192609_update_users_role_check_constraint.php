<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check;");
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('artist', 'admin', 'art_lover'));");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check;");
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('artist', 'admin'));");
    }
};
