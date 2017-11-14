[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2/mini.png)](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/?branch=develop) [![Build Status](https://travis-ci.org/NovikovViktor/SFTPBundle.svg?branch=develop)](https://travis-ci.org/NovikovViktor/SFTPBundle) [![Maintainability](https://api.codeclimate.com/v1/badges/04d63d9f536e077027b0/maintainability)](https://codeclimate.com/github/NovikovViktor/RequestLimitBundle/maintainability)

Symfony2 Helpers - SFTP bundle
=====================

This bundle provide simple interface for transfer files by [SFTP](https://en.wikipedia.org/wiki/SSH_File_Transfer_Protocol) protocol.

Installation
==============

1) Install libssh2-php library:

    ```bash
        // Ubuntu
        sudo apt-get install libssh2-php
        sudo service apache2 restart
        
        //MacOS
        sudo port install libssh2
        sudo pecl install channel://pecl.php.net/ssh2-0.12 
        // when you will be asked about lib prefix put /opt/local , so terminal will look like
        libssh2 prefix? [autodetect] : /opt/local
        
        // enable extension in php.ini
        extension = ssh2.so
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

1) Connect to server via `sf2h.sftp` service:
    
    ```php
       $sftp = $this->get('sf2h.sftp');
       $sftp->connect($host, $port);
       $sftp->login($username, $password);
       // or
       $sftp->loginWithKey($host, $username, $pubkeyfile, $privkeyfile, $passphrase = null);
    ```

2) Use sftp service  to transfer files over SFTP:
    
    ```php
       $sftp->fetchFrom('/path/to/remoteFile', '/path/to/localFile');
       // or
       $sftp->sendTo('/path/to/localFile', '/path/to/remoteFile');
    ```

3) From CLI could be used one of the following commands:
   
    - `php app(bin)/console sf2h:sftp:fetchFrom /path/to/remoteFile /path/to/localFile` - to copy files from remote server to local machine
    - `php app(bin)/console sf2h:sftp:sendTo /path/to/localFile /path/to/remoteFile` - to copy files from local server to remote machine
