<?php
/**
 * Author: darluc
 * Date: 5/10/16
 * Time: 17:18
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class WechatServerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wechat';
    }
}