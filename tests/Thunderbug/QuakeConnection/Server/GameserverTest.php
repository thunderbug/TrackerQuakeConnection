<?php

namespace Thunderbug\QuakeConnection\Server;

use PHPUnit\Framework\TestCase;

class GameserverTest extends TestCase
{
    public function testGetStatus()
    {
        $gameserver = new Gameserver("50.84.40.219", "28744");
        $gameserver->getStatus($cvars, $players);

        $this->assertIsArray($cvars);
        $this->assertIsArray($players);

        $this->assertEquals($cvars, $gameserver->getCvars());
        $this->assertEquals($players, $gameserver->getPlayers());
    }
}
