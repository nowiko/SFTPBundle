<?php

namespace SF2Helpers\SFTPBundle\SFTP;

interface ResourceTransferInterface
{
    /**
     * @param $remoteFile
     * @param $localFile
     * @return mixed
     */
    public function copy($remoteFile, $localFile);

    /**
     * @param $localFile
     * @param $remoteFile
     * @return mixed
     */
    public function send($localFile, $remoteFile);
}
