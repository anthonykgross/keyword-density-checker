<?php

namespace KeywordDensityChecker\Stripper;


interface IStripper
{
    /**
     * @param $content
     * @return mixed
     */
    public function getStripedContent($content);
}