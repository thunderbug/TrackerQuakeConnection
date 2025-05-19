<?php

namespace Thunderbug\QuakeConnection\Server\Rcon;

use PHPUnit\Framework\TestCase;

class RconCodTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function rconSimpleExecute(): void
    {
        $cod4Server = new COD4ServerEmulator();
        $rconCOD = new RconCoD("172.0.0.1", 28960, "test");
        $rconCOD->execute("test");

        $data = $cod4Server->receive();
        $this->assertEquals("\xFF\xFF\xFF\xFFrcon test test\x00", $data);
    }
}