<?php

namespace SF2Helpers\SFTPBundle\SFTP;

class SFTP implements ConnectionInterface, ResourceTransferInterface
{
    /**
     * Connection instance
     *
     * @var $connection
     */
    private $connection;

    /**
     * Established sftp resource
     *
     * @var $sftp
     */
    private $sftp;

    /**
     * @param string      $host
     * @param string      $username
     * @param string|null $password
     */
    public function connect($host, $username, $password = null)
    {
        $connection = ssh2_connect($host);

        is_null($password) ? ssh2_auth_agent($connection, $username) : ssh2_auth_password($connection, $username, $password);

        $this->connection = $connection;
        $this->sftp       = ssh2_sftp($connection);
    }

    /**
     * @param string      $host
     * @param string      $username
     * @param string      $pubkeyfile
     * @param string      $privkeyfile
     * @param string|null $passphrase
     */
    public function connectWithKey($host, $username, $pubkeyfile, $privkeyfile, $passphrase = null)
    {
        $connection = ssh2_connect($host);

        ssh2_auth_pubkey_file($connection, $username, $pubkeyfile, $privkeyfile, $passphrase);

        $this->connection = $connection;
        $this->sftp       = ssh2_sftp($connection);
    }

    /**
     * @param $remoteFile
     * @param $localFile
     * @throws \Exception
     */
    public function copy($remoteFile, $localFile)
    {
        $sftp = "ssh2.sftp://$this->sftp";
        $data = file_get_contents($sftp . $remoteFile);
        if (!$data) {
            throw new \Exception('File can`t be loaded from server');
        }
        file_put_contents($localFile, $data);
    }

    /**
     * @param $localFile
     * @param $remoteFile
     * @throws \Exception
     */
    public function send($localFile, $remoteFile)
    {
        $sftp = "ssh2.sftp://$this->sftp";
        $data = file_get_contents($localFile);
        if (!file_put_contents($sftp . $remoteFile, $data)) {
            throw new \Exception('File could not be uploaded to server');
        }
    }

    /**
     * @param $dir
     * @return array
     */
    public function getFilesList($dir)
    {
        $handle = opendir("ssh2.sftp://$this->sftp" . $dir);
        $files  = [];

        while (false !== ($entry = readdir($handle))) {
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
