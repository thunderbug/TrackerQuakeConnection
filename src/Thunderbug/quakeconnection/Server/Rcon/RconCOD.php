<?php


namespace Thunderbug\QuakeConnection\Server\Rcon;

use Exception;

class RconCOD implements Rcon
{
    private $session;
    private $password;

    /**
     * Rcon constructor.
     *
     * @param string $ip
     * @param int $port
     * @param string $password
     * @throws Exception
     */
    public function __construct(string $ip, int $port, string $password)
    {
        $this->password = $password;
        $this->session = fsockopen("udp://".$ip, $port, $errno, $errstr, 1);
        //Error out if unable to connect
        if(!$this->session) {
            Throw new Exception($errno . ": " . $errstr);
        }

        socket_set_timeout($this->session, 1, 1);
    }

    /**
     * Send data to the gameserver
     *
     * @param string $command
     * @return bool
     */
    public function send(string $command): bool
    {
        $write = fwrite($this->session, "\xFF\xFF\xFF\xFFrcon ".$this->password." ".$command."\x00");
        if($write === false) {
            return false;
        }

        return true;
    }

    /**
     * Receive data from gameserver
     * @return string
     */
    public function receive(): string
    {
        $output = fread ($this->session, 1);
        if(!empty($output)) {
            do {
                $statusPre = socket_get_status($this->session);
                $output = $output . fread($this->session, 1);
                $statusPost = socket_get_status($this->session);
            } while ($statusPre["unread_bytes"] != $statusPost["unread_bytes"]);
        }

        return $output;
    }

    /**
     * Do Command on server
     *
     * @param string $command
     * @return string
     * @throws Exception
     */
    public function doCommand(string $command): string
    {
        $this->send($command);
        $output = $this->receive();

        switch ($command) {
            case "status":
            case "teamstatus":
                return $output;
            case "":
                return str_replace("\n", "", $output);
            default:
                preg_match(" \"(.*)\^7\" ", $output, $matches);
                if(count($matches) == 2) {
                    return $matches[1];
                }
                Throw new Exception("Invalid command response?" . $output);
        }
    }
}