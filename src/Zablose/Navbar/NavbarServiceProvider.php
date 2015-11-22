<?php

use Illuminate\Support\ServiceProvider;

class NavbarServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views/', 'navbar');

        $this->publishes([
            __DIR__ . '/../../config/navbar.php' => config_path('navbar.php')
            ], 'config');

        $this->publishes([
            __DIR__ . '/../../migrations/' => base_path('/database/migrations')
            ], 'migrations');

        $this->publishes([
            __DIR__ . '/../../views/' => base_path('resources/views/vendor/navbar')
            ], 'views');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/navbar.php', 'navbar');
    }

}
