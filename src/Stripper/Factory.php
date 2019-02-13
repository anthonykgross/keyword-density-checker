<?php

namespace KeywordDensityChecker\Stripper;


class Factory
{
    const strippers = [
        'HTML' => Html::class,
        'XML' => Xml::class,
    ];

    /**
     * Factory::strip($content, \Anthonykgross\Striper\MyStripper);
     * @param $content
     * @param $class
     * @return mixed
     */
    static function strip($content, $class)
    {
        if (in_array(IStripper::class, class_implements($class))) {
            /**
             * @var $o IStripper
             */
            $o = new $class();
            return $o->getStripedContent($content);
        }
        return $content;
    }

    /**
     * Factory::stripMultiple($content, ["XML", "HTML"])
     * @param $content
     * @param array $formats
     * @return mixed
     */
    static function stripMultiple($content, $formats = [])
    {
        foreach ($formats as $format) {
            if (array_key_exists($format, self::strippers)) {
                $content = self::strip($content, self::strippers[$format]);
            }
        }
        return $content;
    }
}