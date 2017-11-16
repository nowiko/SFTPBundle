<?php

namespace SF2Helpers\SFTPBundle\SFTP;

interface ResourceTransferInterface
{
    /**
     * Copy remote file to local machine
     *
     * @param $remoteFile
     * @param $localFile
     * @return mixed
     */
    public function fetchFrom($remoteFile, $localFile);

    /**
     * Copy file from local machine to remote
     *
     * @param $localFile
     * @param $remoteFile
     * @return mixed
     */
    public function sendTo($localFile, $remoteFile);

    /**
     * Return array of files names from remote dir
     *
     * @param $remoteDir
     * @return array
     */
    public function getRemoteFilesList($remoteDir);
}
