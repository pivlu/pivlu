<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Registering a filter to modify the query 
        add_filter('test_filter', function ($query) {
            return '<div class="fw-bold">HOOOOOOOOKKKK</div>';
        });
    }

    /**
     * Register all directives.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
