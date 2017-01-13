<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    if (env('APP_DEBUG')) { // debug 模式下打印 php 配置信息
        phpinfo();
    }
    return 'Server is running';
});

Route::resource('weixin/connect', 'WechatController@connect');

Route::group(
    ['prefix' => 'console', 'namespace' => 'Console'],
    function () {
        Route::get('/', 'ConsoleController@index');
    }
);