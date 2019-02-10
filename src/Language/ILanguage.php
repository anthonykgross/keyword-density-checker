<?php
namespace KeywordDensityChecker\Language;


interface ILanguage
{
    /**
     * @param $content
     * @return mixed
     */
    public function getValuableWords($content);
}