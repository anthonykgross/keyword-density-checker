<?php

namespace KeywordDensityChecker\Stripper;

/**
 * Class Html
 * @package Stripper
 */
class Html implements IStripper
{
    const scriptTagRegExp = '/<script[^>]*>[\s\S]*?<\/script>/i';

    /**
     * @param $content
     * @return string
     */
    public function getStripedContent($content)
    {
        $content = $this->stripScriptTags($content);
        $content = $this->stripTags($content);
        $content = $this->stripWhiteSpaces($content);
        $content = $this->stripQuote($content);
        return $this->decodeHtml($content);
    }

    /**
     * @param $content
     * @return null|string|string[]
     */
    private function stripScriptTags($content)
    {
        return preg_replace(self::scriptTagRegExp, '', $content);
    }

    /**
     * @param $content
     * @return string
     */
    private function stripTags($content)
    {
        return strip_tags($content);
    }

    /**
     * @param $content
     * @return null|string|string[]
     */
    private function stripWhiteSpaces($content)
    {
        return preg_replace('/\s+/i', ' ', $content);
    }

    /**
     * @param $content
     * @return null|string|string[]
     */
    private function stripQuote($content)
    {
        return preg_replace('/\'/i', ' ', $content);
    }

    /**
     * @param $content
     * @return string
     */
    private function decodeHtml($content)
    {
        return strtolower(html_entity_decode($content));
    }
}