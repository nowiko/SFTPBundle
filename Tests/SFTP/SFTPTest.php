<?php

namespace SF2Helpers\SFTPBundle\Tests\SFTP;

use SF2Helpers\SFTPBundle\SFTP\SFTP;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SFTPTest extends WebTestCase
{
    /** @var SFTP $sftpService */
    private $sftpService;

    /**
     * Test connect()
     */
    public function testConnect()
    {
        //$this->assertEquals(1, 1);
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
