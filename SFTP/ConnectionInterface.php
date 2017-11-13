<?php

namespace SF2Helpers\SFTPBundle\SFTP;

interface ConnectionInterface
{
    /**
     * Establish connection with remote host
     *
     * @param $host
     * @param $port
     */
    public function connect($host, $port);

    /**
     * Authenticate user to established connection with username and password
     *
     * @param $username
     * @param string|null $password
     */
    public function login($username, $password = null);

    /**
     * Establish connection with remote host via public and private keys
     *
     * @param $username
     * @param $publicKeyFile
     * @param $privateKeyFile
     * @param string|null $passPhrase
     */
    public function loginWithKey($username, $publicKeyFile, $privateKeyFile, $passPhrase = null);

    /**
     * Implementation of this function should close established connection
     */
    public function disconnect();
}
