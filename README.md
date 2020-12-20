[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2/mini.png)](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/?branch=develop) [![Build Status](https://travis-ci.org/nowiko/SFTPBundle.svg?branch=master)](https://travis-ci.org/nowiko/SFTPBundle) [![Maintainability](https://api.codeclimate.com/v1/badges/72c8963111d07dacf0c6/maintainability)](https://codeclimate.com/github/NovikovViktor/SFTPBundle/maintainability)

SFTP Bundle
=====================

This bundle provides a simple interface for transfer files by SFTP protocol.

Installation
==============

1) Install the bundle using Composer:
 ```bash
  composer require nw/sftp-bundle
 ```

2) Enable bundle in `AppKernel.php`

 ```php
class AppKernel extends Kernel
{
   public function registerBundles()
   {
       return array(
           // ... other bundles
           new NW\SFTPBundle\NWSFTPBundle()
        );
    }
}
 ```

Usage
=======

1) Connect to the SFTP server:
 ```php
    $sftp = $this->get('nw.sftp');
    $sftp->connect($host, $port);
    $sftp->login($username, $password);
    // or
    $sftp->loginWithKey($host, $username, $pubkeyfile, $privkeyfile, $passphrase = null);
 ```

2) Use SFTP client to transfer files:
```php
    $sftp->fetch('/path/to/remoteFile', '/path/to/localFile');
    // or
    $sftp->send('/path/to/localFile', '/path/to/remoteFile');
```

3) From CLI could be used one of the following commands:
```bash
app/console nw:sftp:fetch /path/to/remoteFile /path/to/localFile # - copy files from a remote server to the local machine
# or
app/console nw:sftp:send /path/to/localFile /path/to/remoteFile # - copy files from a local machine to the remote server
```
