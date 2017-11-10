<?php

namespace SF2Helpers\SFTPBundle\Tests\SFTP;

use SF2Helpers\SFTPBundle\SFTP\SFTP;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SFTPTest extends WebTestCase
{
    // test credentials took from here - http://www.sftp.net/public-online-sftp-servers
    private $hostname = 'demo.wftpserver.com:2222';
    private $login    = 'demo-user';
    private $password = 'demo-user';

    /** @var SFTP $sftpService */
    private $sftpService;

    /**
     * Test connect()
     */
    public function testConnect()
    {
        $this->sftpService->connect($this->hostname, $this->login, $this->password);
    }

    /**
     * Test connect()
     */
    public function testGetRemoteFilesList()
    {
        $this->sftpService->connect($this->hostname, $this->login, $this->password);
    }

    /**
     * Set up fixtures for testing
     */
    public function setUp()
    {
        require_once __DIR__.'/../AppKernel.php';
        $kernel = new \AppKernel('test', true);
        $kernel->boot();
        $container         = $kernel->getContainer();
        $this->sftpService = $container->get('sf2h.sftp');
    }
}
