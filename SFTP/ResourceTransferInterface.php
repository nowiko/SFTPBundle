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
    public function copy($remoteFile, $localFile);

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
    public function getRemoteFilesList($remoteDir);
}
