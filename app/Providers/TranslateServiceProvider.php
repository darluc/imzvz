<?php

namespace Furbook\Providers;

use Furbook\Services\GoogleTranslateEngine;
use Illuminate\Support\ServiceProvider;

class TranslateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(['Furbook\\Services\\TranslateService' => 'translateEngine'], function ($app) {
            return new GoogleTranslateEngine();
        });
    }

    public function provides()
    {
        return ['translateEngine', 'Furbook\\Services\\GoogleTranslation'];
    }
}
