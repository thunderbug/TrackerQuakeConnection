<?php

namespace Thunderbug\QuakeConnection;

use PHPUnit\Framework\TestCase;
use Thunderbug\QuakeConnection\Connection;

class ConnectionTest extends TestCase
{
    public function testConnection() {
        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        $connection = new Connection("127.0.0.1", 5000);
        socket_recvfrom($socket, $buf, 512, 0, $remote_ip, $remote_port);
        echo $remote_ip.":".$remote_port;
    }
}
