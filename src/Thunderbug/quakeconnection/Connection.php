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
     * @var false|resource
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
        if ($this->connection === false) {
            new \Exception("Connection failed ".$errno.": ".$errstr);
        }
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
     * @return array buffer
     */
    public function read() : array
    {
        $buffer = array();

        while ($buff = fread($this->connection, 16384)) {
            $buffer[] = $buff;
        }

        return $buffer;
    }
}