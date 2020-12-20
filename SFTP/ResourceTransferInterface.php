<?php

namespace NW\SFTPBundle\SFTP;

/**
 * Interface ResourceTransferInterface
 * @package NW\SFTPBundle\SFTP
 * @author Novikov Viktor
 */
interface ResourceTransferInterface
{
    /**
     * Copy remote file to local machine
     *
     * @param $remoteFile
     * @param $localFile
     * @return mixed
     */
    public function fetch($remoteFile, $localFile);

    /**
     * Copy file from local machine to remote
     *
     * @param $localFile
     * @param $remoteFile
     * @return mixed
     */
    public function send($localFile, $remoteFile);

    /**
     * Return array of files names from remote dir
     *
     * @param $remoteDir
     * @return array
     */
    public function getFilesList($remoteDir);
}
