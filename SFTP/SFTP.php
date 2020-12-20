<?php

namespace NW\SFTPBundle\SFTP;

/**
 * Class SFTP
 * @package NW\SFTPBundle\SFTP
 * @author Novikov Viktor
 */
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
    public function connect($host, $port)
    {
        $this->connection = ssh2_connect($host, $port);
    }

    /**
     * {@inheritdoc}
     */
    public function login($username, $password = null)
    {
        if (!$this->connection) {
            throw new \LogicException('Establish connection with server before login');
        }
        is_null($password) ? ssh2_auth_agent($this->connection, $username) : ssh2_auth_password($this->connection, $username, $password);
        $this->sftp = ssh2_sftp($this->connection);
    }

    /**
     * {@inheritdoc}
     */
    public function loginWithKey($username, $publicKeyFile, $privateKeyFile, $passPhrase = null)
    {
        if (!$this->connection) {
            throw new \LogicException('Establish connection with server before login');
        }
        ssh2_auth_pubkey_file($this->connection, $username, $publicKeyFile, $privateKeyFile, $passPhrase);
        $this->sftp = ssh2_sftp($this->connection);
    }

    /**
     * {@inheritdoc}
     */
    public function fetch($remoteFile, $localFile)
    {
        $remoteData = file_get_contents('ssh2.sftp://' . intval($this->sftp) . $remoteFile);
        if (!$remoteData) {
            throw new \Exception('File can`t be loaded from the SFTP server.');
        }
        file_put_contents($localFile, $remoteData);
    }

    /**
     * {@inheritdoc}
     */
    public function send($localFile, $remoteFile)
    {
        if (!file_exists($localFile)) {
            throw new \Exception('Local file doesn\'t exists.');
        }

        $sftp = "ssh2.sftp://" . intval($this->sftp);
        $data = file_get_contents($localFile);

        if (!file_put_contents($sftp . $remoteFile, $data)) {
            throw new \Exception('File could not be uploaded to the SFTP server.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFilesList($remoteDir)
    {
        $handle = opendir("ssh2.sftp://" . intval($this->sftp) . $remoteDir);
        $files  = array();

        if (is_bool($handle)) {
            throw new \Exception('Could not read files list from remote SFTP server. Check your connection.');
        }

        while (false !== ($entry = readdir($handle))) {
            $files[] = $entry;
        }

        return $files;
    }

    /**
     * {@inheritdoc}
     */
    public function disconnect()
    {
        unset($this->connection);
        unset($this->sftp);
    }
}
