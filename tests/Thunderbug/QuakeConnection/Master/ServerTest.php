<?php

namespace Thunderbug\QuakeConnection\Master;

use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    /**
     * Test the data class server
     */
    public function testServer()
    {
        $ip = "192.168.1.165";
        $port = 28960;

        $server = new Server($ip, $port);

        $this->assertEquals($ip, $server->getIp());
        $this->assertEquals($port, $server->getPort());

        $ip = "192.168.1.166";
        $port = 28961;

        $server->setIp($ip);
        $server->setPort($port);

        $this->assertEquals($ip, $server->getIp());
        $this->assertEquals($port, $server->getPort());
    }
}
