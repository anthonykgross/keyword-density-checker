<?php
include('vendor/autoload.php');

$url = "https://anthonykgross.fr";
$content = file_get_contents($url);
$out = null;

//Retrait de toutes les balises scripts du code
$regexpscript = '/<script[^>]*>[\s\S]*?<\/script>/i';
//Retrait de toutes les balises styles
$regexpstyle = '/<style[^>]*>[\s\S]*?<\/style>/i';
//Retrait de tous les commentaires
$regexpcommentaires = '/\/\**[\s\S]*?\*\//i';

$noScriptingTagContent = preg_replace($regexpscript, '', $content);
$noStyleTagContent = preg_replace($regexpstyle, '', $noScriptingTagContent);
$noCommentTagContent = preg_replace($regexpcommentaires, '', $noStyleTagContent);

$noTagContent = strip_tags($noStyleTagContent);
$noTagContent = preg_replace('/\s+/i', ' ', $noTagContent);
$noTagContent = preg_replace('/\'/i', ' ', $noTagContent);
$content = strtolower($noTagContent);

$frenchAccentLetter = 'àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ';

$words = str_word_count($content, 1, $frenchAccentLetter);

$smallWords = ['le', 'la', 'l', 'un', 'une', 'du', 'de', 'de', 'la', 'les',
    'des', 'ce', 'cet', 'cette', 'mon', 'ton', 'son', 'notre', 'votre',
    'leur', 'un', 'ces', 'peu'
];

$wordsDensity = [];

$wordLengthMinLimit = 4;

foreach($words as $word) {
	if(strlen($word) > $wordLengthMinLimit && !array_search($word, $smallWords)){
		if (!isset($wordsDensity[$word])){
			$wordsDensity[$word] = 0;
		}
		$wordsDensity[$word] += 1;
	}
}
$nbWords = count($wordsDensity);
arsort($wordsDensity);

$shortWordsDensity = array_slice($wordsDensity, 0, 20, true);

echo "-------------------------------------\n";
foreach($shortWordsDensity as $word => $density) {
	$percent = floor($density/$nbWords*100);
	echo "| $word : $density ($percent%)\n";
	echo "-------------------------------------\n";
}