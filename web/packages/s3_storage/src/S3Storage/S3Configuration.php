<?php

namespace S3Storage;

use Aws\Credentials\CredentialProvider;
use Aws\S3\S3Client;
use Concrete\Core\Error\Error;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\File\StorageLocation\Configuration\Configuration;
use Concrete\Core\File\StorageLocation\Configuration\ConfigurationInterface;
use Concrete\Core\File\StorageLocation\Configuration\DeferredConfigurationInterface;
use Concrete\Core\Http\Request;
use Core;
use League\Url\Url;

class S3Configuration extends Configuration implements ConfigurationInterface, DeferredConfigurationInterface
{
    /**
     * @var string|null
     */
    public $bucket;

    /**
     * @var string|null
     */
    public $key;

    /**
     * @var string|null
     */
    public $secret;

    /**
     * @var int|null
     */
    public $expire;

    /**
     * @var bool
     */
    public $expire_enabled = false;

    /**
     * @var string|null
     */
    public $region;

    /**
     * @var string|null
     */
    public $base_url;

    /**
     * @var bool
     */
    public $useIAM = false;

    /**
     * @var bool Ideally, the default value should be false, but it's set to null to maintain backward compatibility.
     */
    public $useACL;

    /**
     * @var int
     */
    public $cache = 0;

    /**
     * @var bool
     */
    public $cacheEnabled = false;

    /** @var S3Client */
    protected $client;

    /**
     * @return bool
     */
    public function hasPublicURL()
    {
        return true;
    }

    /**
     * @return false
     */
    public function hasRelativePath()
    {
        return false;
    }

    /**
     * @param \Concrete\Core\Http\Request $req
     *
     * @return void
     */
    public function loadFromRequest(Request $req)
    {
        $data = $req->get('fslType');
        $this->useIAM = (isset($data['useIAM'])) ? $data['useIAM'] : false;
        $this->useACL = (isset($data['useACL'])) ? $data['useACL'] : false;
        $this->bucket = (isset($data['bucket'])) ? $data['bucket'] : null;
        $this->key = (isset($data['key'])) ? $data['key'] : null;
        $this->secret = (isset($data['secret'])) ? $data['secret'] : null;
        $this->expire = (isset($data['expire'])) ? (int) $data['expire'] : null;
        $this->expire_enabled = (isset($data['expire_enabled'])) ? $data['expire_enabled'] : false;
        $this->region = (isset($data['region'])) ? $data['region'] : null;
        $this->base_url = (isset($data['base_url'])) ? $data['base_url'] : null;
        $this->cache = (isset($data['cache'])) ? (int) $data['cache'] : 0;
        $this->cacheEnabled = !empty($data['cache_enabled']) ? 1 : 0;
    }

    /**
     * @param \Concrete\Core\Http\Request $req
     *
     * @return Error
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function validateRequest(Request $req)
    {
        $e = Core::make(ErrorList::class);
        $this->loadFromRequest($req);

        if (!$this->bucket) {
            $e->add(t('You must set a S3 Bucket.'));
        } elseif (!S3Client::isBucketDnsCompatible($this->bucket)) {
            $e->add(t('Invalid S3 Bucket Name'));
        }
        if (!$this->region) {
            $e->add(t('You must supply a region, eg: us-east-1, us-west-1, eu-west-1'));
        }

        if (!$this->useIAM) {
            if (!$this->key) {
                $e->add(t('You must set a S3 Key.'));
            }
            if (!$this->secret) {
                $e->add(t('You must set a S3 Secret.'));
            }
            if ($this->expire_enabled && ((int) $this->expire !== 0 && strtotime($this->expire) === false)) {
                $e->add(t('Invalid Expire Time'));
            }
        }

        if ($this->cacheEnabled) {
            if ($this->cache <= 0) {
                $e->add(t('Cache Expiry Time must be a positive number.'));
            }
            if (!$this->cache) {
                $e->add(t('Invalid Cache Expiry Time.'));
            }
        }

        return $e;
    }

    /**
     * @return AwsS3Adapter
     */
    public function getAdapter()
    {
        return new AwsS3Adapter($this->getClient(), $this->bucket, null, $this->getOptions());
    }

    /**
     * @param $file
     *
     * @return \Psr\Http\Message\UriInterface|string
     */
    public function getPublicURLToFile($file)
    {
        $file = trim($file, '/');
        if ($this->expire_enabled) {
            $cmd = $this->getClient()->getCommand('GetObject', [
                'Bucket' => $this->bucket,
                'Key' => $file,
            ]);
            $expire = strtotime($this->expire);

            return $this->getClient()->createPresignedRequest($cmd, $expire)->getUri();
        }

        $url = $this->getClient()->getObjectUrl($this->bucket, $file);
        if (strlen($this->base_url)) {
            $url = Url::createFromUrl($this->base_url);
            $url->setPath($file);
        }

        return (string) $url;
    }

    /**
     * @param $file
     *
     * @return string
     */
    public function getRelativePathToFile($file)
    {
        return $file;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getOptions()
    {
        $options = [];
        if ($this->cacheEnabled && $this->cache > 0) {
            $options['CacheControl'] = 'max-age=' . $this->cache;
        }

        if ($this->useACL === false) {
            $options['ACL'] = AwsS3Adapter::ACL_BUCKET_OWNER_FULL_CONTROL;
        }

        return $options;
    }

    /**
     * @return S3Client
     */
    protected function getClient()
    {
        if (isset($this->client)) {
            return $this->client;
        }

        if (!$this->region) {
            $this->region = 'us-east-1';
        }

        if ($this->useIAM) {
            $provider = CredentialProvider::defaultProvider();
            $cachedProvider = CredentialProvider::memoize($provider);
            $this->client = new S3Client([
                'credentials' => $cachedProvider,
                'region' => $this->region,
                'version' => 'latest',
            ]);
            return $this->client;
        }

        $conf = [
            'credentials' => [
                'key' => $this->key,
                'secret' => $this->secret,
            ],
            'region' => $this->region,
            'version' => 'latest',
        ];

        return new S3Client($conf);
    }
}

/**
 * This code is a hack because c5 broke autoloading and uses a serialized object so the class has to match >.<
 * Remember to blame Korvin for this...
 */

namespace Concrete\Package\S3Storage\Core\File\StorageLocation\Configuration;

class S3Configuration extends \S3Storage\S3Configuration
{
}
