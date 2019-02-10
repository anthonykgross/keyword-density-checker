<?php

namespace KeywordDensityChecker\Language;


class Factory
{
    const languages = [
        'FR' => French::class
    ];

    /**
     * @param $content
     * @param $class
     * @return mixed
     */
    static function getValuableWords($content, $class) {
        if (in_array(ILanguage::class, class_implements($class))) {
            /**
             * @var $o ILanguage
             */
            $o = new $class();
            return $o->getValuableWords($content);
        }
        return $content;
    }

    /**
     * @param $content
     * @param array $languages
     * @return mixed
     */
    static function getValuableWordsMultiple($content, $languages = []) {
        foreach ($languages as $language) {
            if (array_key_exists($language, self::languages)) {
                $content = self::getValuableWords($content, self::languages[$language]);
            }
        }
        return $content;
    }
}