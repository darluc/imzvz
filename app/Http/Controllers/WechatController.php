<?php

namespace Furbook\Http\Controllers;

use EasyWeChat\Server\Guard;
use Illuminate\Http\Request;

use Furbook\Http\Requests;

class WechatController extends Controller
{
    public function connect(Request $request){
        /** @var Guard $server */
        $server = app('wechat')->server;

        if(!$request->isMethod('get')) {
            // only add message handler when the request is not using a get method
            $server->setMessageHandler(function ($message) {
                return "您好！欢迎关注我!";
            });
        }
        
        return $server->serve();
    }
}
