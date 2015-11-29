<?php

namespace SF2Helpers\SFTPBundle\SFTP;

interface ConnectionInterface {
    public function connect($host, $username, $password);
    public function disconnect();
}
