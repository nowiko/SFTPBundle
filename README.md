[![SensioLabsInsight](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2/mini.png)](https://insight.sensiolabs.com/projects/e0b26b60-76f3-40a4-9416-9b6c65fb93a2) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/NovikovViktor/SFTPBundle/?branch=develop)

Symfony2 Helpers - SFTP bundle
=====================

This bundle provide simple interface for transfer files by [SFTP](https://en.wikipedia.org/wiki/SFTP) protocol.

Installation:

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

4) Use service `sftp` for transfering files by SFTP. Details about service usage see here.
