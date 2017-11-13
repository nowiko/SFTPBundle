<?php

namespace SF2Helpers\SFTPBundle\Tests\SFTP;

use SF2Helpers\SFTPBundle\SFTP\SFTP;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SFTPTest extends WebTestCase
{
    // test credentials took from here - http://www.sftp.net/public-online-sftp-servers
    private $hostname = 'demo.wftpserver.com';
    private $port     = '2222';
    private $login    = 'demo-user';
    private $password = 'demo-user';

    /** @var SFTP $sftpService */
    private $sftpService;

    /**
     * Test connect()
     */
    public function testConnect()
    {
        $sftpService = $this->sftpService;
        $sftpService->connect($this->hostname, $this->port);
        $sftpService->login($this->login, $this->password);
        $sftpService->disconnect();
    }

    /**
     * Test getRemoteFilesList()
     */
    public function testGetRemoteFilesList()
    {
        $sftpService = $this->sftpService;
        $sftpService->connect($this->hostname, $this->port);
        $sftpService->login($this->login, $this->password);

        $filesList = $sftpService->getRemoteFilesList('/download');

        $this->assertTrue(is_array($filesList));
        $this->assertTrue(count($filesList) > 0);

        $sftpService->disconnect();
    }

    /**
     * Test sendTo()
     */
    public function testSendTo()
    {
        $sftpService = $this->sftpService;
        $sftpService->connect($this->hostname, $this->port);
        $sftpService->login($this->login, $this->password);

//        $sftpService->sendTo('/Library/WebServer/Documents/SFTPBundle/Tests/test.txt', '/upload/1.txt');

        $sftpService->disconnect();
    }

    /**
     * Test sendTo()
     */
    public function testFetchFrom()
    {
        $sftpService = $this->sftpService;
        $sftpService->connect($this->hostname, $this->port);
        $sftpService->login($this->login, $this->password);

        $sftpService->fetchFrom('/download/manual_ed.pdf', '/Library/WebServer/Documents/SFTPBundle/Tests/ttt.pdf');

        $sftpService->disconnect();
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

    /**
     * Shut down test suite
     */
    public function tearDown()
    {
        unset($this->sftpService);
    }
}
