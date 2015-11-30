<?php

namespace SF2Helpers\SFTPBundle\SFTP;

class SFTP implements ConnectionInterface, ResourceTransferInterface
{
    private $connection; // connection instance

    private $sftp; // established sftp


    public function __construct()
    {
    }

    public function connect($host, $username, $password)
    {
        $connection = ssh2_connect($host);
        ssh2_auth_password($connection, $username, $password);
        $sftp = ssh2_sftp($connection);
        $this->connection = $connection;
        $this->sftp = $sftp;
    }

    public function copy($remoteFile, $localFile)
    {
        $sftp = "ssh2.sftp://$this->sftp";
        $data = file_get_contents($sftp . $remoteFile);
        if (!$data) {
            throw new \Exception('File can`t be loaded from server');
        }
        file_put_contents($localFile, $data);
    }

    public function send($localFile, $remoteFile)
    {
        $sftp = "ssh2.sftp://$this->sftp";
        $data = file_get_contents($localFile);
        if (!file_put_contents($sftp . $remoteFile, $data)) {
            throw new \Exception('File could not be uploaded to server');
        }
    }

    public function getFilesList($dir) {
        $handle = opendir("ssh2.sftp://$this->sftp" . $dir);
        $files = array();

        while (false != ($entry = readdir($handle))){
            $files[] = $entry;
        }

        return $files;
    }

    public function disconnect()
    {
        ssh2_exec($this->connection, 'exit');
        unset($this->connection);
    }
} 
