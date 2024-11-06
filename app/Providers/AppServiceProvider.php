<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::addNamespace('Auth', resource_path('views/pages/auth'));
        View::addNamespace('Admin', resource_path('views/pages/admin'));
        View::addNamespace('User', resource_path('views/pages/user'));
    }
}