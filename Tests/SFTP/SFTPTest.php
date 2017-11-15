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
     * Test getRemoteFilesList()
     */
    public function testGetRemoteFilesList()
    {
        $filesList = $this->sftpService->getRemoteFilesList('/download');

        $this->assertTrue(is_array($filesList));
        $this->assertTrue(count($filesList) > 0);
    }

    /**
     * Test sendTo()
     */
    public function testSendTo()
    {
//        $this->sftpService->sendTo(dirname(__FILE__).'/../fixtures/test.txt', '/upload/testfile_42563624.txt');
    }

    /**
     * Test sendTo()
     */
    public function testFetchFrom()
    {
//        $this->sftpService->fetchFrom('/download/manual_en.pdf', dirname(__FILE__).'/../fixtures/manual_en.pdf');
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

        $this->sftpService->connect($this->hostname, $this->port);
        $this->sftpService->login($this->login, $this->password);
    }

    /**
     * Shut down test suite
     */
    public function tearDown()
    {
        $this->sftpService->disconnect();
        unset($this->sftpService);
        if (file_exists(dirname(__FILE__).'/../fixtures/manual_en.pdf')) {
            unlink(dirname(__FILE__).'/../fixtures/manual_en.pdf');
        }
    }
}
