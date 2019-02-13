<?php

namespace KeywordDensityChecker\Tests\Stripper;


use KeywordDensityChecker\Stripper\Html;
use PHPUnit\Framework\TestCase;

class HtmlTest extends TestCase
{
    public function testGetStripedContent()
    {
        $content = '<div>T\'as vu lequel de mes streams sur Dart</div>';
        $htmlStripper = new Html();
        $result = $htmlStripper->getStripedContent($content);
        /**
         * @todo Should be case sensitive
         */
        //$this->assertEquals("T'as vu lequel de mes streams sur Dart", $result);
        $this->assertEquals("t as vu lequel de mes streams sur dart", $result);
    }

    public function testGetStripedComplexContent()
    {
        $content = '<div><i><qskmkhf><span>Bonne réponse Louis</span></div>';
        $htmlStripper = new Html();
        $result = $htmlStripper->getStripedContent($content);
        /**
         * @todo Should be case sensitive
         */
        //$this->assertEquals("Bonne réponse Louis", $result);
        $this->assertEquals("bonne réponse louis", $result);
    }
}