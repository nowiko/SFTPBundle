<?php

namespace SF2Helpers\SFTPBundle\Command;

use SF2Helpers\SFTPBundle\SFTP\SFTP;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendToCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sf2h:sftp:sendTo')
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
        /** @var SFTP $sftp */
        $sftp = $this->get('sftp');

        try {
            $output->writeln('Started sending file to remote SFTP server.');
            $sftp->sendTo($input->getArgument('localFile'), $input->getArgument('remoteFile'));
            $output->writeln('Successful sending file to the SFTP server.');
        } catch (\Exception $e) {
            $output->writeln('File transfer failed.');
        }
    }
}
