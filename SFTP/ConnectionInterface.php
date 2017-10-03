<?php

namespace SF2Helpers\SFTPBundle\SFTP;

interface ConnectionInterface
{
    /**
     * @param $host
     * @param $username
     * @param $password
     * @return mixed
     */
    public function connect($host, $username, $password);

    public function disconnect();
}
