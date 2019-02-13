<?php

namespace KeywordDensityChecker\Language;


class French implements ILanguage
{
    const file = __DIR__ . '/../Data/French.json';
    /**
     * @var string
     */
    private $charList = null;
    /**
     * @var array
     */
    private $stopWords = [];
    /**
     * @var array
     */
    private $charSuccessors = [];

    /**
     * French constructor.
     */
    public function __construct()
    {
        $json = json_decode(file_get_contents(self::file), true);
        $this->stopWords = $json['stop_words'];
        $this->charSuccessors = $json['char_successors'];
        $this->charList = $json['char_list'];
    }

    /**
     * @param $content
     * @return array|mixed
     */
    public function getValuableWords($content)
    {
        $words = str_word_count($content, 1, $this->charList);
        $words = array_diff($words, $this->stopWords);
        return array_count_values($words);
    }
}