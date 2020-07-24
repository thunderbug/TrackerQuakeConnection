<?php

namespace Thunderbug\QuakeConnection\Server;

use PHPUnit\Framework\TestCase;

class ColorsTest extends TestCase
{
    public function testHtmlColors()
    {
        $colors = "^7Te^5est^6Test";
        $html_colors = Colors::colorize($colors);

        $this->assertEquals("<span style=\"color: #ffffff;\">Te</span><span style=\"color: #00ffff;\">est</span><span style=\"color: #ff00ff;\">Test</span>", $html_colors);
    }

    public function testRemoveColors()
    {
        $colors = "^7Te^5est^6Test";
        $removed_colors = Colors::removeColors($colors);
        print($removed_colors);
        $this->assertEquals("TeestTest", $removed_colors);
    }
}
