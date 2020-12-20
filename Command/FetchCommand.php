<?php

namespace NW\SFTPBundle\Command;

use NW\SFTPBundle\SFTP\SFTP;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FetchCommand
 * @package NW\SFTPBundle\Command
 * @author Novikov Viktor
 */
class FetchCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nw:sftp:fetch')
            ->setDefinition(array(
                new InputArgument('remoteFile', InputArgument::REQUIRED, 'Full path to remote file'),
                new InputArgument('localFile', InputArgument::REQUIRED, 'Full path to local file')
            ))
            ->setDescription('Copy file from remote SFTP server to the local machine')
            ->setHelp("
                The <info>./app/console nw:sftp:fetch</info> command copies file from remote SFTP server to your local machine by the specified path:
                Command example:
                  <info>./app/console nw:sftp:fetch /path/to/remoteFile.txt /path/to/localFile.txt</info>
            ");
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var SFTP $sftp */
        $sftp = $this->get('sftp');

        try {
            $output->writeln('Started fetching a file from a remote SFTP server.');
            $sftp->fetch($input->getArgument('remoteFile'), $input->getArgument('localFile'));
            $output->writeln('Successful file transfer from the SFTP server.');
        } catch (\Exception $e) {
            $output->writeln('File transfer failed.');
        }
    }
}
