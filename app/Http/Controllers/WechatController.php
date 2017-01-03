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
            $sig = $request->input('signature');
            // only add message handler when the request is not using a get method
            $server->setMessageHandler(function ($message) use ($sig) {
                // cause google translation costs much time and wechat server have three tries, cache the first
                // translation response will help.
                if($ret = \Cache::pull($sig)) {
                    return $ret;
                } else {
                    $ret = "更多功能, 敬请期待!!!";
                    switch ($message->MsgType) {
                        case 'text':
                            $ret = $this->textMessage($message);
                        case 'voice':
                            $ret = $this->voiceMessage($message);
                    }
                    \Cache::put($sig, $ret, 10);
                    return $ret;
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
        \Log::debug('try to translate: ', [$content]);
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
