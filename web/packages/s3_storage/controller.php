<?php

namespace Concrete\Package\S3Storage;

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Error\UserMessageException;
use Concrete\Core\File\StorageLocation\StorageLocationFactory;
use Concrete\Core\Application\UserInterface\Dashboard\Navigation\NavigationCache;
use Concrete\Core\File\StorageLocation\Type\Type;
use Concrete\Core\Http\Request;
use Concrete\Core\Http\ServerInterface;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single;
use Concrete\Core\Routing\RedirectResponse;
use Core;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use S3Storage\Http\Middleware\CloudfrontSignedCookieMiddleware;
use S3Storage\S3Configuration;
use Symfony\Component\ClassLoader\Psr4ClassLoader;
use Symfony\Component\HttpFoundation\Cookie;

/**
 *
 * @author Michael Krasnow <mnkras@gmail.com>
 * @author Derek Cameron <info@derekcameron.com>
 * @author Katz Ueno <iam@katzueno.com>
 * @author Md Biplob Hossain <biplob.ice@gmail.com>
 * @copyright 2024 Macareux Digital
 *
 */

class Controller extends Package
{
    protected $pkgHandle = 's3_storage';
    protected $appVersionRequired = '8.5.6';
    protected $phpVersionRequired = '7.2.5';
    protected $pkgVersion = '3.2.0-rc6';

    public function getPackageDescription()
    {
        return t("File storage using Amazon S3.");
    }

    public function getPackageName()
    {
        return t("S3 Storage");
    }

    /**
     * @throws \Concrete\Core\Error\UserMessageException|\Exception
     */
    public function install()
    {
        // Check if the composer dependencies are installed
        if (!file_exists(__DIR__ . '/vendor')) {
            throw new UserMessageException(t('Please install composer dependencies before you install this package. Run `cd "%s" && composer install`', __DIR__));
        }

        $pkg = parent::install();

        // Make sure we load everything.
        $this->on_start();

        Type::add('s3', 'Amazon S3', $pkg);
        $this->installSinglePages($pkg);
    }

    public function upgrade()
    {
        $this->installSinglePages($this->getPackageEntity());
        $this->updateConfig();

        parent::upgrade();
    }

    /**
     * @throws \Illuminate\Filesystem\FileNotFoundException|\Exception
     */
    public function on_start()
    {
        $this->registerAutoload();
        $this->registerMiddlewares();
        $this->registerEventListeners();
    }

    /**
     * @return void
     * @throws \Concrete\Core\Error\UserMessageException
     */
    protected function registerAutoload()
    {
        $fs = new Filesystem();

        if (!class_exists(AwsS3Adapter::class)) {
            try {
                $fs->getRequire(__DIR__ . '/vendor/autoload.php');
            } catch (FileNotFoundException $e) {
                throw new UserMessageException(t('You forgot to run composer :/'));
            }
        }

        $loader = new Psr4ClassLoader();
        $loader->addPrefix('\\S3Storage', __DIR__ . '/src/S3Storage/');
        //This is to account for c5 changing autoloading in 5.7.4 >.< (Korvin's fault)
        $loader->addPrefix(
            '\\Concrete\\Package\\S3Storage\\Core\\File\\StorageLocation\\Configuration',
            __DIR__ . '/src/S3Storage/'
        );
        $loader->addPrefix(
            '\\Concrete\\Package\\S3Storage\\Src\\File\\StorageLocation\\Configuration',
            __DIR__ . '/src/S3Storage/'
        );
        $loader->addPrefix(
            '\\Concrete\\Package\\S3Storage\\File\\StorageLocation\\Configuration',
            __DIR__ . '/src/S3Storage/'
        );
        $loader->register();

        //This is also needed because c5 won't autoload the class anymore
        Core::bind(
            '\Concrete\Package\S3Storage\Src\File\StorageLocation\Configuration\S3Configuration',
            'S3Storage\S3Configuration'
        );
        Core::bind(
            '\Concrete\Package\S3Storage\Core\File\StorageLocation\Configuration\S3Configuration',
            'S3Storage\S3Configuration'
        );
        Core::bind(
            '\Concrete\Package\S3Storage\File\StorageLocation\Configuration\S3Configuration',
            'S3Storage\S3Configuration'
        );
    }

    protected function registerMiddlewares()
    {
        /** @var ServerInterface $server */
        $server = $this->app->make(ServerInterface::class);
        $server->addMiddleware($this->app->make(CloudfrontSignedCookieMiddleware::class), 5); // Before Cookie Middleware (10)
    }

    protected function registerEventListeners()
    {
        $director = $this->app->make('director');
        $director->addListener('on_user_logout', function ($event) {
            $config = $this->getFileConfig();
            $domain = $config->get('cloudfront_signed_cookie.domain');
            if (!$domain) {
                $request = Request::getInstance();
                $domain = $request->getHost();
            }

            /** @var \Concrete\Core\User\Event\Logout | \Symfony\Contracts\EventDispatcher\Event $event */
            if ($event instanceof \Concrete\Core\User\Event\Logout) {
                $response = $event->getResponse();
                if (!$response) {
                    $response = new RedirectResponse('/');
                }
                $response->headers->setCookie(new Cookie('CloudFront-Policy', null, 0, '/', $domain, true, true));
                $response->headers->setCookie(new Cookie('CloudFront-Signature', null, 0, '/', $domain, true, true));
                $response->headers->setCookie(new Cookie('CloudFront-Key-Pair-Id', null, 0, '/', $domain, true, true));
                $response->headers->setCookie(new Cookie('CloudFront-Signature-Expires', null, 0, '/', null, true, true));
                $event->setResponse($response);
            } else {
                // Check if headers are already sent to avoid errors
                if (!headers_sent()) {
                    header('Set-Cookie: CloudFront-Policy=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain=' . $domain . '; secure; HttpOnly');
                    header('Set-Cookie: CloudFront-Signature=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain=' . $domain . '; secure; HttpOnly');
                    header('Set-Cookie: CloudFront-Key-Pair-Id=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain=' . $domain . '; secure; HttpOnly');
                    header('Set-Cookie: CloudFront-Signature-Expires=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; secure; HttpOnly');
                }
            }
        });
    }

    protected function installSinglePages($pkg)
    {
        $page = Page::getByPath('/dashboard/system/files/cloudfront_signed_cookie');
        if (!$page || $page->isError()) {
            $page = Single::add('/dashboard/system/files/cloudfront_signed_cookie', $pkg);
            $page->updateCollectionName(t('CloudFront Signed Cookie'));
        }

        if (class_exists(NavigationCache::class)) {
            /** @var \Concrete\Core\Application\UserInterface\Dashboard\Navigation\NavigationCache $navigationCache */
            $navigationCache = $this->app->make(NavigationCache::class);
            $navigationCache->clear();
        }
    }

    /**
     * Checks and updates the storage configuration for existing S3 storage locations where ACL is enabled.
     */
    protected function updateConfig()
    {
        /** @var \Concrete\Core\Database\Connection\Connection $db */
        $db = $this->app->make('database/connection');
        $locations = $this->app->make(StorageLocationFactory::class)->fetchList();
        foreach ($locations as $location) {
            $configuration = $location->getConfigurationObject();
            if (($configuration instanceof S3Configuration) && $configuration->useACL === null) {
                $configuration->useACL = true;
                $db->executeQuery('UPDATE FileStorageLocations SET fslConfiguration = ? WHERE fslID = ?', [serialize($configuration), $location->getID()]);
            }
        }
    }
}
