<?php
include('vendor/autoload.php');

$url = "https://anthonykgross.fr";
$content = file_get_contents($url);

$regexp = '/<script[^>]*>[\s\S]*?<\/script>/i';
$out = null;

$noScriptingTagContent = preg_replace($regexp, '', $content);
$noTagContent = strip_tags($noScriptingTagContent);
$content = preg_replace('/\s+/i', ' ', $noTagContent);
$content = preg_replace('/\'/i', ' ', $noTagContent);
$content = strtolower($content);

$frenchAccentLetter = 'àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ';

$words = str_word_count($content, 1, $frenchAccentLetter);

$smallWords = ['le', 'la', 'l', 'un', 'une', 'du', 'de', 'de', 'la', 'les',
    'des', 'ce', 'cet', 'cette', 'mon', 'ton', 'son', 'notre', 'votre',
    'leur', 'un', 'ces', 'peu'
];

$wordsDensity = [];

$wordLengthMinLimit = 4;

foreach($words as $word) {

    if(strlen($word) > $wordLengthMinLimit){
        if (!array_key_exists($word, $wordsDensity)) {
            $wordsDensity[$word] = 0;
        }
        $wordsDensity[$word] += 1;
    }
}


function echo_top_k($sorted_array, $k)
{
    $width = 40;
    $echo_word_and_stats = function ($count, $word, $nbWords) use($width)
    {
        $percent = floor($count / $nbWords * 100);
        echo "| $word : $count ($percent%) | \n";
        echo str_repeat("-", $width);
        echo "\n";
    };

    $top_words = array_slice($sorted_array, 0, $k);
    $nbWords = count($sorted_array);

    echo str_repeat("-", $width);
    echo "\n";
    array_walk($top_words, $echo_word_and_stats, $nbWords);
}


arsort($wordsDensity);
echo_top_k($wordsDensity, 5);


