<?php

namespace App\Providers;

use EasyWeChat\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
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
        $this->app->singleton(['EasyWeChat\\Foundation\\Application' => 'wechat'], function($app){
            $wechatServer = new Application(config('wechat'));
            return $wechatServer;
        });
    }

    public function provides()
    {
        return ['wechat', 'EasyWeChat\\Foundation\\Application'];
    }

}
