<?php

use KeywordDensityChecker\Language\French;
use KeywordDensityChecker\Stripper\Factory;
use KeywordDensityChecker\Stripper\Html;

include('vendor/autoload.php');

//$htmlStriper = new Html();
//echo $htmlStriper->getStripedContent(file_get_contents('https://anthonykgross.fr'));

//echo Factory::strip(file_get_contents('https://anthonykgross.fr'), Html::class);

//echo Factory::stripMultiple(file_get_contents('https://anthonykgross.fr'), ['HTML']);
echo Factory::stripMultiple(file_get_contents('https://anthonykgross.fr'), ['HTML', 'XML']);

//$french = new French();
//$french->getValuableWords('developpeur développeur');