[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2/mini.png)](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/?branch=develop)

Symfony2 Helpers - SFTP bundle
=====================

This bundle provide simple interface for transfer files by [SFTP](https://en.wikipedia.org/wiki/SFTP) protocol.

Installation
==============

1) Install libssh2-php library:

    ```bash
        sudo apt-get install libssh2-php
        sudo service apache2 restart
    ```

2) Install bundle using Composer:

    ```bash
        composer require sf2h/sftp-bundle
    ```

3) Enable bundle in `AppKernel.php`

    ```php
        class AppKernel extends Kernel
        {
            public function registerBundles()
            {
                $bundles = array(
                    // ... some other bundles
                    new SF2Helpers\SFTPBundle\SF2HelpersSFTPBundle()
             }

             // ... other code
        }
    ```
Usage
=======

1) Use service `sf2h.sftp` to transfer files over SFTP:
    
    ```php
       $this->get('sf2h.sftp')->copy('/path/to/remoteFile', '/path/to/localFile');
       // or
       $this->get('sf2h.sftp')->send('/path/to/localFile', '/path/to/remoteFile');
    ```

2) From CLI could be used one of the following commands:
   
    - `php app(bin)/console sftp:copy` - to copy files from remote server to local machine
    - `php app(bin)/console sftp:send` - to copy files from local server to remote machine
