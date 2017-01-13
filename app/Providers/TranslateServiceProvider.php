<?php

namespace App\Providers;

use App\Services\GoogleTranslateEngine;
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
        $this->app->bind(['App\\Services\\TranslateService' => 'translateEngine'], function ($app) {
            return new GoogleTranslateEngine();
        });
    }

    public function provides()
    {
        return ['translateEngine', 'App\\Services\\GoogleTranslation'];
    }
}
