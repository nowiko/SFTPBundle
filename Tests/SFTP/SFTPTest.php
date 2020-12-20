<?php

namespace NW\SFTPBundle\Tests\SFTP;

use NW\SFTPBundle\SFTP\SFTP;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SFTPTest
 * @package NW\SFTPBundle\Tests\SFTP
 * @author Novikov Viktor
 */
class SFTPTest extends WebTestCase
{
    // test credentials took from here - http://www.sftp.net/public-online-sftp-servers
    private $hostname = 'test.rebex.net';
    private $port     = '22';
    private $login    = 'demo';
    private $password = 'password';

    /** @var SFTP $sftpService */
    private $sftpService;

    /**
     * Test send()
     */
    public function testSend()
    {
        // TESTING OF SEND METHOD IS DISABLED BECAUSE TEST SERVER ONLY ALLOW READS
        //$this->sftpService->send(dirname(__FILE__).'/../fixtures/b629855d08.png', '/pub/example/b629855d08.png');
    }

    /**
     * Test getFilesList()
     * @depends testSend
     */
    public function testGetFilesList()
    {
        $filesList = $this->sftpService->getFilesList('/pub/example');
        $this->assertTrue(is_array($filesList));
        $this->assertTrue(count($filesList) > 0);
    }

    /**
     * Test fetch()
     * @depends testSend
     */
    public function testFetchFrom()
    {
        $this->sftpService->fetch('/pub/example/readme.txt', dirname(__FILE__).'/../fixtures/readme.txt');
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
        $this->sftpService = $container->get('nw.sftp');

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
        if (file_exists(dirname(__FILE__).'/../fixtures/readme.txt')) {
            unlink(dirname(__FILE__).'/../fixtures/readme.txt');
        }
    }
}
