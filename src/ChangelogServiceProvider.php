<?php

namespace Pro1\Changelog;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ChangelogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load package routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');


        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'changelogs');

        // Publish assets
        $this->publishes([
            __DIR__.'/../public/' => public_path('vendor/pro1/changelog'),
        ], 'public');

        // $this->loadRoutesFrom(function () {
        //     Route::middleware(['web', 'auth']) //
        //         ->group(__DIR__.'/../routes/web.php');
        // });

        Route::middleware('api')
        ->prefix('api')
        ->group(__DIR__.'/../src/routes/api.php');

        $this->callAfterResolving(\Illuminate\Database\Seeder::class, function ($seeder) {
            $seeder->call(\Pro1\Changelog\Database\Seeders\ChangeTypeSeeder::class);
            $seeder->call(\Pro1\Changelog\Database\Seeders\PriorityLevelSeeder::class);
            $seeder->call(\Pro1\Changelog\Database\Seeders\ReleaseTypeSeeder::class);
        });

        // Publish config, views, assets
        // $this->publishes([
        //     __DIR__.'/../config/changelog.php' => config_path('changelog.php'),
        // ], 'config');
    }

    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/../config/changelog.php',
            'changelog'
        );
    }
}
