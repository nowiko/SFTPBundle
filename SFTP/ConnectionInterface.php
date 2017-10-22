<?php

namespace SF2Helpers\SFTPBundle\SFTP;

interface ConnectionInterface
{
    /**
     * Establish connection with remote host via username and password
     *
     * @param $host
     * @param $username
     * @param $password
     */
    public function connect($host, $username, $password);

    /**
     * Establish connection with remote host via public and private keys
     *
     * @param $host
     * @param $username
     * @param $pubkeyfile
     * @param $privkeyfile
     * @param null $passphrase
     */
    public function connectWithKey($host, $username, $pubkeyfile, $privkeyfile, $passphrase = null);

    /**
     * Implementation of this function should close established connection
     */
    public function disconnect();
}
