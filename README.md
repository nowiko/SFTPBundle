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
