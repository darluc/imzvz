<?php
/**
 * Author: darluc
 * Date: 5/11/16
 * Time: 09:40
 */

namespace App\Services;


interface TranslateService
{
    /**
     * Do the translation action.
     * @param null $content
     * @return mixed
     */
    public function translate($content = null);

    /**
     * Set the content that will be translated.
     * @param $content
     * @return mixed
     */
    public function setContent($content);

    /**
     * Set the target language. If target is empty, it means auto-detect language.
     * @param null $target
     * @return mixed
     */
    public function setTarget($target = null);

    /**
     * Set the source language. If target is empty, it means auto-detect language.
     * @param null $source
     * @return mixed
     */
    public function setSource($source = null);
}