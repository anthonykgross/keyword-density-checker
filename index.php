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
$nbWords = count($wordsDensity);
arsort($wordsDensity);

echo "-------------------------------------\n";
for ($i = 0; $i < 20; $i++){
//    $w = array_key_first($wordsDensity);
//    echo "-------------------------------------\n";
//    echo "| $w \n";
}

$i = 0;
foreach($wordsDensity as $word => $density) {
    if($i < 20) {
        $percent = floor($density/$nbWords*100);
        echo "| $word : $density ($percent%)\n";
        echo "-------------------------------------\n";
        $i++;
    }
}