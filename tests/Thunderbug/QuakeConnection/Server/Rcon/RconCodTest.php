<?php

namespace Thunderbug\QuakeConnection\Server\Rcon;

use PHPUnit\Framework\TestCase;
use Thunderbug\QuakeConnection\Connection;

class RconCodTest extends TestCase
{
    /**
     * Generate a gameserver emulation
     * @return false|resource|\Socket
     */
    private function generateGameserverUDP()
    {
        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_bind($socket, '127.0.0.1', 5000);

        return $socket;

        //socket_recvfrom($socket, $buf, strlen($test_data), 0, $remote_ip, $remote_port);

    }



}