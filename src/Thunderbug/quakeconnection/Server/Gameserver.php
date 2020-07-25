<?php


namespace Thunderbug\QuakeConnection\Server;


use Thunderbug\QuakeConnection\Connection;

/**
 * Class Gameserver
 *
 * Retrieve information from a gameserver
 *
 * @package Thunderbug\QuakeConnection\Server
 */
class Gameserver extends Connection
{
    protected $cvars = array();
    protected $players = array();

    /**
     * Get Status information of the server
     * @param array|null $cvars
     * @param array|null $players
     */
    public function getStatus(array &$cvars = null, array &$players = null)
    {
        $this->write("\xFF\xFF\xFF\xFFgetstatus\x00");
        $players = explode("\n", $this->read());
        array_shift($players);
        array_pop($players);

        $cvars = array_shift($players);
        $cvars = explode('\\', $cvars);
        array_shift($cvars);

        $this->parse_cvars($cvars);
        $this->parse_players($players);

        $cvars = $this->cvars;
        $players = $this->players;
    }

    /**
     * Parse cvars into an correct formatted array
     * @param array $cvars
     */
    protected function parse_cvars(array $cvars)
    {
        for ($i = 0; $i < count($cvars); $i++) {
            $this->cvars[$cvars[$i]] = $cvars[++$i];
        }
    }

    /**
     * Parse players into an correct formatted array
     * @param array $players
     */
    protected function parse_players(array $players)
    {
        $this->players = [];

        $regex = '#([0-9]+) ([0-9]+) "(.*)"#';
        foreach ($players as $player) {
            preg_match($regex, $player, $info);
            $this->players[] = [
                "player" => $info[3],
                "score" => $info[1],
                "ping" => $info[2]
            ];
        }
    }

    /**
     * Get the public cvars of a server
     * @return array
     */
    public function getCvars()
    {
        return $this->cvars;
    }

    /**
     * Get the playerlist of a gameserver
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }
}