<?php

namespace Furbook\Http\Controllers;

use Illuminate\Http\Request;

use Furbook\Http\Requests;

class WechatController extends Controller
{
    public function connect(){
        $response = app('wechat')->server->serve();
        return $response;
    }
}
