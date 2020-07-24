<?php

namespace Thunderbug\QuakeConnection;

use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    /**
     * Test the Connection Class if it is able to read and write to a udp server
     * @throws \Exception
     */
    public function testConnection() {
        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_bind($socket, '127.0.0.1', 5000);

        $connection = new Connection("127.0.0.1", 5000);

        $test_data = random_bytes(rand(0, 20));
        $connection->write($test_data);

        socket_recvfrom($socket, $buf, strlen($test_data), 0, $remote_ip, $remote_port);
        $this->assertEquals($test_data, $buf);
    }
}
