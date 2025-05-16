<?php


namespace Thunderbug\QuakeConnection\Server\Rcon;

class RconCoD implements Rcon
{
    private string $password;
    private $socket;

    /**
     * Class constructor.
     * @param string $host
     * @param int $port
     * @param string $password
     */
    public function __construct(string $host, int $port, string $password)
    {
        $this->password = $password;

        //create connection to the required server
        $this->socket = fsockopen("udp://".$host, $port );

        //Timeout rather quickly
        socket_set_timeout($this->socket, 1, 1);
    }

    /**
     * Execute a command on the server
     * @param string $command
     * @return string
     */
    public function execute(string $command): string
    {
        //Write data
        $written = fwrite($this->socket, "\xFF\xFF\xFF\xFFrcon " . $this->password . " " . $command . "\x00");
        if ($written === false) {
            return false;
        }

        //Read data
        $output = fread($this->socket, 1);
        if (!empty($output)) {
            do {
                $statusPre = socket_get_status($this->socket);
                $output = $output . fread($this->socket, 1);
                $statusPost = socket_get_status($this->socket);
            } while ($statusPre["unread_bytes"] != $statusPost["unread_bytes"]);

            switch ($command) {
                case "status":
                case "teamstatus":
                    return $output;
                case "":
                    return str_replace("\n", "", $output);
                default:
                    preg_match('/"(.*)" is: "(.*)" /', $output, $output_array);
                    return $output_array[2];
            }
        }

        return $output;
    }

    /**
     * Push a command to the server without reading it
     * @param string $command
     * @return void
     */
    private function push(string $command): void
    {
        fwrite($this->socket, "\xFF\xFF\xFF\xFFrcon " . $this->password . " " . $command . "\x00");
    }

    /**
     * Kick a user from the server
     * @param int $id IngameID
     * @param ?string $reason Reason
     * @return bool Succeeded
     */
    public function kick(int $id, ?string $reason = null): bool
    {
        if ($reason != null) {
            $this->publicmessage($reason);
        }

        $this->execute("clientkick " . $id);
        return true;
    }

    /**
     * Public Message
     * @param string $message message
     * @return bool Succeeded
     */
    public function publicMessage(string $message): bool
    {
        $this->push("say ".$message);
        return true;
    }

    /**
     * Private Message
     * @param int $id
     * @param string $message
     * @return bool Succeeded
     */
    public function privateMessage(int $id, string $message): bool
    {
        $this->push("tell ". $id. " ".$message);
        return true;
    }

    /**
     * Print a banner ingame
     * @param string $text text of the banner
     */
    public function printBanner(string $text): void
    {
        $this->publicMessage($text);
    }
}