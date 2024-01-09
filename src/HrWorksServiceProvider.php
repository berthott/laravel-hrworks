<?php

namespace berthott\HrWorks;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

/**
 * Register the libraries features with the laravel application.
 */
class HrWorksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // add config
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'hrworks');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // publish config
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('hrworks.php'),
        ], 'config');

        // register log channel
        $this->app->make('config')->set('logging.channels.hrworks', [
            'driver' => 'daily',
            'path' => storage_path('logs/hrworks.log'),
            'level' => 'debug',
        ]);

        // publish config
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        // load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Disable Data Wrapping on resources
        JsonResource::withoutWrapping();
    }
}
