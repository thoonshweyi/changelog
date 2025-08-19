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
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');


        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'changelogs');

        Route::middleware('web')
        ->prefix('changelog-assets')
        ->group(function () {
            Route::get('{path}', function ($path) {
                $file = __DIR__ . '/../public/assets/' . $path;

                if (!file_exists($file)) {
                    abort(404);
                }

                $mime = mime_content_type($file);
                return response()->file($file, [
                    'Content-Type' => $mime
                ]);
            })->where('path', '.*');
        });

        // $this->loadRoutesFrom(function () {
        //     Route::middleware(['web', 'auth']) //
        //         ->group(__DIR__.'/../routes/web.php');
        // });

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
