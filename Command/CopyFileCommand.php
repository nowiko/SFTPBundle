<?php

namespace SF2Helpers\SFTPBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CopyFileCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sftp:copy')
            ->setDefinition(array(
                new InputArgument('remoteFile', InputArgument::REQUIRED, 'Full path to remote file'),
                new InputArgument('localFile', InputArgument::REQUIRED, 'Full path to local file')
            ))
            ->setDescription('Copy file from remote SFTP server to local machine')
            ->setHelp("
The <info>./app/console sftp:copy</info> command copies file from remote SFTP server to your local machine by specified path:
Command example:
  <info>./app/console sftp:copy /path/to/remoteFile.txt /path/to/localFile.txt</info>
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
