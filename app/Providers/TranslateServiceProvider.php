<?php

namespace Furbook\Providers;

use Furbook\Services\GoogleTranslation;
use Illuminate\Support\ServiceProvider;

class TranslateServiceProvider extends ServiceProvider
{
    protected $defer = true;
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
        $this->app->bind('Furbook\\Services\\TranslateService', function($app){
            return new GoogleTranslation();
        });
    }
}
