<?php

namespace Furbook\Http\Controllers;

use Log;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\Voice;
use EasyWeChat\Server\Guard;
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
                switch ($message->MsgType) {
                    case 'text':
                        return $this->textMessage($message);
                    case 'voice':
                        return $this->voiceMessage($message);
                    default:
                        return "更多功能, 敬请期待!!!";
                }
            });
        }

        return $server->serve();
    }

    private function textMessage($message)
    {
        $content = $message->Content;
        return $this->translateIt($content);
    }

    private function voiceMessage($message)
    {
        if (!empty($message->Recognition)) {
            return $this->translateIt($message->Recognition);
        }else{
            return 'ˋ(′o‵")ˊ';
        }
    }

    private function translateIt($content)
    {
        /** @var TranslateService $tr */
        $tr = app('translateEngine');
        // if it is Chinese, set target language to English
        if (preg_match("/[\\x{4e00}-\\x{9fa5}]/u", $content)) {
            $tr->setTarget('en');
        }
        try {
            return $tr->translate($content);
        } catch (\Exception $ex) {
            Log::warning('Translate from google failed', [$content, $ex]);
            return 'Sorry, something goes wrong. Please wait a moment.';
        }
    }
}
