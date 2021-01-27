<?php

namespace Thunderbug\QuakeConnection\Server;

use PHPUnit\Framework\TestCase;

class GameserverTest extends TestCase
{
    public function testGetStatus()
    {
        $gameserver = new Gameserver("cod4.thunderbug.be", "28960");
        $gameserver->getStatus($cvars, $players);

        $this->assertIsArray($cvars);
        $this->assertIsArray($players);

        $this->assertEquals($cvars, $gameserver->getCvars());
        $this->assertEquals($players, $gameserver->getPlayers());
    }
}
