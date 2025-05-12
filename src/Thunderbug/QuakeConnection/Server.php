<?php


namespace Thunderbug\QuakeConnection\Master;

/**
 * Class Server
 *
 * Server object
 *
 * @package Thunderbug\QuakeConnection
 */
class Server
{
    private $ip;
    private $port;

    /**
     * Server constructor.
     * @param string $ip
     * @param int $port
     */
    public function __construct(string $ip, int $port)
    {
        $this->ip = $ip;
        $this->port = $port;
    }

    /**
     * Get IPAddress
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Set IPAddress
     * @param string $ip
     * @return Server
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get Port
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Set Port
     * @param int $port
     * @return Server
     */
    public function setPort(int $port)
    {
        $this->port = $port;

        return $this;
    }
}