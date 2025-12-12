<?php

namespace Vista\Providers;

use Vista\Console\Commands\VistaCommand;
use Illuminate\Support\ServiceProvider;

class VistaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../../config/vista.php' => config_path('vista.php'),
        ], 'vista-config');

        // Publish views
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/vista'),
        ], 'vista-views');

        // Publish assets (Vue build output)
        $this->publishes([
            __DIR__.'/../../resources/js/dashboard' => resource_path('js/vendor/vista'),
        ], 'vista-assets');

        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'vista');

        // Allow publishing views into the host app
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/vista'),
        ], 'vista-views');
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        // Merge default config
        $this->mergeConfigFrom(
            __DIR__.'/../../config/vista.php', 'vista'
        );

        // Register artisan commands
        $this->commands([
            VistaCommand::class,
        ]);
    }
}
