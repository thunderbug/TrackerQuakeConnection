<?php

namespace Thunderbug\QuakeConnection\Server\Rcon;

/**
 * Interface Rcon
 *
 * @package Thunderbug\QuakeConnection\Server\Rcon
 */
interface Rcon
{
    /**
     * Execute a command on the server
     * @param $command String Command
     * @return string data
     */
    public function execute(string $command): string;

    /**
     * Kick
     * @param $id int Ingame ID
     * @param $reason ?String Reason
     * @return bool Succeeded
     */
    public function kick(int $id, ?string $reason): bool;

    /**
     * Public Message
     * @param $message String message
     * @return bool Succeeded
     */
    public function publicMessage(string $message): bool;

    /**
     * Private Message
     * @param int $id
     * @param string $message
     * @return bool Succeeded
     */
    public function privateMessage(int $id, string $message): bool;

    /**
     * Print a banner inGame
     * @param $text string text of the banner
     */
    public function printBanner(string $text): void;
}