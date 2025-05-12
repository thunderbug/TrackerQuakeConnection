<?php

namespace Thunderbug\QuakeConnection\Server\Rcon;

/**
 * Interface Rcon
 * @package Thunderbug\QuakeConnection\Server\Rcon
 */
interface Rcon
{
    /**
     * Rcon constructor.
     *
     * @param string $ip
     * @param int $port
     * @param string $password
     */
    public function __construct(string $ip, int $port, string $password);

    /**
     * Send data to the gameserver
     *
     * @param string $command
     * @return bool
     */
    public function send(string $command): bool ;

    /**
     * Receive data from gameserver
     * @return string
     */
    public function receive(): string ;
}