<?php
/**
 * Author: darluc
 * Date: 5/11/16
 * Time: 09:54
 */

namespace Furbook\Services;


use Furbook\Services\TranslateService;
use Stichoza\GoogleTranslate\TranslateClient;

class GoogleTranslation implements TranslateService
{
    protected $content;
    /** @var TranslateClient */
    protected $client;

    protected $source;
    protected $target;

    public function __construct()
    {
        $this->client = new TranslateClient();
    }

    private function googleTranslate()
    {
        $target = $this->target ?: 'zh-CN';
        return $this->client->setSource($this->source)->setTarget($target)->translate($this->content);
    }

    /**
     * Do the translation action.
     * @param null $content
     * @return mixed
     */
    public function translate($content = null)
    {
        if (!empty($content)) {
            $this->setContent($content);
        }
        return $this->googleTranslate();
    }

    /**
     * Set the content that will be translated.
     * @param $content
     * @return GoogleTranslation
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set the target language. If target is empty, it means auto-detect language.
     * @param null $target
     * @return GoogleTranslation
     */
    public function setTarget($target = null)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Set the source language. If target is empty, it means auto-detect language.
     * @param null $source
     * @return GoogleTranslation
     */
    public function setSource($source = null)
    {
        $this->source = $source;
        return $this;
    }
}