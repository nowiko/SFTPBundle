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
     * @inheritdoc
     */
    public function connect($host, $username, $password = null)
    {
        $connection = ssh2_connect($host);

        is_null($password) ? ssh2_auth_agent($connection, $username) : ssh2_auth_password($connection, $username, $password);

        $this->connection = $connection;
        $this->sftp       = ssh2_sftp($connection);
    }

    /**
     * @inheritdoc
     */
    public function connectWithKey($host, $username, $pubkeyfile, $privkeyfile, $passphrase = null)
    {
        $connection = ssh2_connect($host);

        ssh2_auth_pubkey_file($connection, $username, $pubkeyfile, $privkeyfile, $passphrase);

        $this->connection = $connection;
        $this->sftp       = ssh2_sftp($connection);
    }

    /**
     * @inheritdoc
     */
    public function fetchFrom($remoteFile, $localFile)
    {
        $sftp = "ssh2.sftp://$this->sftp";
        $data = file_get_contents($sftp . $remoteFile);
        if (!$data) {
            throw new \Exception('File can`t be loaded from server');
        }
        file_put_contents($localFile, $data);
    }

    /**
     * @inheritdoc
     */
    public function sendTo($localFile, $remoteFile)
    {
        $sftp = "ssh2.sftp://$this->sftp";
        $data = file_get_contents($localFile);
        if (!file_put_contents($sftp . $remoteFile, $data)) {
            throw new \Exception('File could not be uploaded to server');
        }
    }

    /**
     * @inheritdoc
     */
    public function getRemoteFilesList($dir)
    {
        $handle = opendir("ssh2.sftp://$this->sftp" . $dir);
        $files  = array();

        while (false !== ($entry = readdir($handle))) {
            $files[] = $entry;
        }

        return $files;
    }

    /**
     * @inheritdoc
     */
    public function disconnect()
    {
        ssh2_exec($this->connection, 'exit');
        unset($this->connection);
    }
}
