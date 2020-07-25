<?php


namespace Thunderbug\QuakeConnection;

/**
 * Class Connection
 *
 * UDP connection base
 *
 * @package Thunderbug\quakeconnection
 */
class Connection
{
    /**
     * @var resource
     */
    protected $connection;

    /**
     * Connection constructor.
     * @param string $ip
     * @param int $port
     */
    public function __construct(string $ip, int $port)
    {
        $this->connection = fsockopen("udp://".$ip, $port, $errno, $errstr, 30);
        if ($this->connection == false) {
            new \Exception("Connection failed ".$errno.": ".$errstr);
        }

        stream_set_timeout($this->connection, 0, 300000);
    }

    /**
     * write data to the connection
     * @param String $data
     * @return int bytes written
     */
    public function write(String $data) : int
    {
        return fputs($this->connection, $data);
    }

    /**
     * Receive data from the connection
     * @return string data
     */
    public function read() : string
    {
        $data = "";

        do {
            $data .= fread($this->connection, 1);
            $status = socket_get_status($this->connection);
        }
        while($status["unread_bytes"] != 0);

        return $data;
    }
}