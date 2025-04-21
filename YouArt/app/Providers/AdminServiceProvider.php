<?php

namespace App\Providers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\WorkshopController;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Http\Controllers\Admin\AdminController', AdminController::class);
        $this->app->bind('App\Http\Controllers\Admin\WorkshopController', WorkshopController::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
