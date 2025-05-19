<?php


namespace Thunderbug\QuakeConnection\Master;

use Exception;
use Socket;
use Thunderbug\QuakeConnection\Server\PublicInformation;

/**
 * Class Server
 *
 * Server object
 *
 * @package Thunderbug\QuakeConnection
 */
class Server
{
    private string $ip;
    private int $port;
    private ?string $password = null;
    private ?PublicInformation $publicInformation = null;

    /**
     * Server constructor.
     * @param string $ip
     * @param int $port
     * @param string|null $password
     */
    public function __construct(string $ip, int $port, ?string $password)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->password = $password;
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
     * Get Port
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Get remote control password
     * @return string|null
     */
    protected function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Get public accessible information
     * @return PublicInformation
     * @throws Exception
     */
    public function getPublicInformation(): PublicInformation
    {
        if($this->publicInformation === null) {
            $this->publicInformation = new PublicInformation($this->ip, $this->port);
        }

        return $this->publicInformation;
    }
}