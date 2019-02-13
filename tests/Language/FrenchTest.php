<?php

namespace KeywordDensityChecker\Tests\Language;

use KeywordDensityChecker\Language\French;
use PHPUnit\Framework\TestCase;

class FrenchTest extends TestCase
{
    public function testGetValuableWords()
    {
        $content = 'je crois qu\'il y a moyen avec Loockys, il est fan de ton accent';
        $language = new French();
        $result = $language->getValuableWords($content);

        $this->assertEquals(
            [
                "crois" => 1,
                "qu'il" => 1,
                "moyen" => 1,
                "Loockys" => 1,
                "fan" => 1,
                "accent" => 1
            ],
            $result
        );
    }


    public function testGetValuableWords2()
    {
        $content = "Je suis mi français, mi marseillais et re mi marseillais derrière.";
        $language = new French();
        $result = $language->getValuableWords($content);

        $this->assertEquals(
            [
                'Je' => 1,
                'mi' => 3,
                'français' => 1,
                'marseillais' => 2,
                're' => 1
            ],
            $result
        );
    }
}