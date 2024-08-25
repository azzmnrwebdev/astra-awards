<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrapFive();
        Blade::component('layouts.guest', 'guest');
        Blade::component('layouts.admin', 'admin');
        Blade::component('layouts.user', 'user');
        Blade::component('admin.components.navbar', 'admin-navbar');
        Blade::component('admin.components.sidebar', 'admin-sidebar');
        Blade::component('components.navbar', 'user-navbar');
        Blade::component('components.header', 'user-header');
        Blade::component('components.footer', 'user-footer');
    }
}
