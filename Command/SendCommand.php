<?php

namespace NW\SFTPBundle\Command;

use NW\SFTPBundle\SFTP\SFTP;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SendCommand
 * @package NW\SFTPBundle\Command
 * @author Novikov Viktor
 */
class SendCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nw:sftp:send')
            ->setDefinition(array(
                new InputArgument('localFile', InputArgument::REQUIRED, 'Full path to local file'),
                new InputArgument('remoteFile', InputArgument::REQUIRED, 'Full path to remote file')
            ))
            ->setDescription('Send a file to remote SFTP server from local machine')
            ->setHelp("
                The <info>./app/console nw:sftp:send</info> command copies file to remote SFTP server from your local machine by the specified path:
                Command example:
                  <info>./app/console nw:sftp:send /path/to/localFile.txt /path/to/remoteFile.txt</info>
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
            $output->writeln('Started sending a file to a remote SFTP server.');
            $sftp->send($input->getArgument('localFile'), $input->getArgument('remoteFile'));
            $output->writeln('Successful file transfer to the SFTP server.');
        } catch (\Exception $e) {
            $output->writeln('File transfer failed.');
        }
    }
}
