<?php

namespace Thunderbug\QuakeConnection\Master;

use Thunderbug\QuakeConnection\Connection;

/**
 * Class Master
 *
 * Connection to the master server of a specified game
 *
 * @package Thunderbug\quakeconnection
 */
class Master extends Connection
{
    /**
     * @var int
     */
    private $protocol;

    /**
     * Master constructor.
     * @param string $ip
     * @param int $port
     * @param int|null $protocol
     */
    public function __construct(string $ip, int $port, ?int $protocol = 0)
    {
        $this->protocol = $protocol;

        parent::__construct($ip, $port);
    }

    /**
     * Get Server List from the master server
     * @return Server[]
     */
    public function getServerList(): array
    {
        $replace = array(
            "\xFF\xFF\xFF\xFFgetserversResponse\n",
            "\\EOF",
            "\\EOT"
        );

        $servers = array();

        $this->write("\xFF\xFF\xFF\xFFgetservers ".$this->protocol." full empty");
        $data = $this->read_master();

        foreach ($data as $row) {
            $row = str_replace($replace, "", $row);
            $row = explode("\x5c", $row);
            foreach ($row as $server) {
                if (strlen($server) == 6) {
                    $serverInfo = unpack("Nip/nport", $server);
                    $servers[] = new Server(long2ip($serverInfo["ip"]), $serverInfo["port"]);
                }
            }
        }

        return $servers;
    }

    /**
     * Receive data from the master
     * @return array buffer
     */
    public function read_master() : array
    {
        $buffers = array();

        while ($buff = fread($this->connection, 16384)) {
            $buffers[] = $buff;
        }

        return $buffers;
    }
}