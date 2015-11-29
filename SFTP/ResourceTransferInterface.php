<?php

namespace SF2Helpers\SFTPBundle\SFTP;

interface ResourceTransferInterface
{
    public function copy($remoteFile, $localFile);

    public function send($localFile, $remoteFile);
}
