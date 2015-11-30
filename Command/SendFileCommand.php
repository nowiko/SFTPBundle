<?php

namespace SF2Helpers\SFTPBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendFileCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sftp:send')
            ->setDefinition(array(
                new InputArgument('localFile', InputArgument::REQUIRED, 'Full path to local file'),
                new InputArgument('remoteFile', InputArgument::REQUIRED, 'Full path to remote file')
            ))
            ->setDescription('Send file to remote SFTP server from local machine')
            ->setHelp("
The <info>./app/console sftp:send</info> command copies file to remote SFTP server from your local machine by specified path:
Command example:
  <info>./app/console sftp:send /path/to/localFile.txt /path/to/remoteFile.txt</info>
            ");
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sftp = $this->get('sftp');
    }
}
