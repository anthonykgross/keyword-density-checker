<?php
namespace KeywordDensityChecker;

class KeywordDensityChecker
{
    /**
     * @var $content
     */
    private $content;

    public function __construct($content) {
        $this->content = $content;
    }
}