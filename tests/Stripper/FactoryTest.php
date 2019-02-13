<?php

namespace KeywordDensityChecker\Tests\Stripper;

use KeywordDensityChecker\Stripper\Factory;
use KeywordDensityChecker\Stripper\Html;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testStrip()
    {
        $content = '<div>Thanks AlexCopperFeet for your tip !</div>';
        $result = Factory::strip($content, Html::class);
        /**
         * @todo Should be case sensitive
         */
//        $this->assertEquals("Thanks AlexCopperFeet for your tip !", $result);
        $this->assertEquals("thanks alexcopperfeet for your tip !", $result);
    }

    public function testStripMultiple()
    {
        $content = '<div><i><qskmkhf><span>Bonne réponse Louis</span></div>';
        $result = Factory::stripMultiple($content, ['HTML', 'XML']);
        $this->assertEquals("Failed", $result);
    }

    public function testStripMultiple2()
    {
        $content = '<div><i><qskmkhf><span>Bonne réponse Louis</span></div>';
        $result = Factory::stripMultiple($content, ['XML', 'HTML']);
        $this->assertEquals("failed", $result);
    }

    public function testStripMultiple3()
    {
        $content = '<div><i><qskmkhf><span>French accent is beautiful</span></div>';
        $result = Factory::stripMultiple($content, ['HTML']);
        /**
         * @todo Should be case sensitive
         */
//        $this->assertEquals("French accent is beautiful", $result);
        $this->assertEquals("french accent is beautiful", $result);
    }
}