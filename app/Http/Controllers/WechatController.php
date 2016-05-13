<?php

namespace Furbook\Http\Controllers;

use EasyWeChat\Message\Text;
use EasyWeChat\Server\Guard;
use Furbook\Services\GoogleTranslateEngine;
use Furbook\Services\TranslateService;
use Illuminate\Http\Request;

use Furbook\Http\Requests;

class WechatController extends Controller
{
    public function connect(Request $request)
    {
        /** @var Guard $server */
        $server = app('wechat')->server;

        if (!$request->isMethod('get')) {
            // only add message handler when the request is not using a get method
            $server->setMessageHandler(function ($message) {
                if ($message->MsgType == 'text') {
                    // do the translation
                    /** @var TranslateService $tr */
                    $tr = app('translateEngine');
                    $content = $message->content;
                    // if it is Chinese, set target language to English
                    if(preg_match("/[\\x{4e00}-\\x{9fa5}]/u",$content)){
                        $tr->setTarget('en');
                    }
                    return $tr->translate($content);
                } else {
                    return "您好！欢迎关注我!";
                }
            });
        }

        return $server->serve();
    }
}
