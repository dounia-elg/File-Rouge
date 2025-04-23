<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force file session driver
        Config::set('session.driver', 'file');
        
        // Set database timeout - try/catch in case of database not being PostgreSQL
        try {
            DB::statement('SET statement_timeout = 120000');
        } catch (\Exception $e) {
            // Silently fail if not PostgreSQL
        }
    }
}
