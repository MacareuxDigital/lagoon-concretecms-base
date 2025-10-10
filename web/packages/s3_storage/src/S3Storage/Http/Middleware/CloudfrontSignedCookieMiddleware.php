<?php

namespace S3Storage\Http\Middleware;

use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;
use Concrete\Core\Application\Application;
use Concrete\Core\Authentication\AuthenticationType;
use Concrete\Core\Cookie\CookieJar;
use Concrete\Core\File\Filesystem;
use Concrete\Core\Http\Middleware\DelegateInterface;
use Concrete\Core\Http\Middleware\MiddlewareInterface;
use Concrete\Core\Logging\LoggerFactory;
use Concrete\Core\Permission\Access\Entity\Entity;
use Concrete\Core\Permission\Checker;
use Concrete\Core\Permission\Key\Key;
use Concrete\Core\Routing\RedirectResponse;
use Concrete\Core\User\PersistentAuthentication\CookieService;
use Concrete\Core\User\User;
use S3Storage\Traits\PackageTrait;
use Symfony\Component\HttpFoundation\Request;

class CloudfrontSignedCookieMiddleware implements MiddlewareInterface
{
    use PackageTrait;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function process(Request $request, DelegateInterface $frame)
    {
        $config = $this->getPackageConfig();
        if ($config) {
            /** @var CookieJar $cookieJar */
            $cookieJar = $this->app->make(CookieJar::class);
            // If the signed cookie is already set, we don't need to set it again
            if ($cookieJar->has('CloudFront-Signature')) {
                return $frame->next($request);
            }

            // Weather or not to set the signed cookie
            $shouldSetCookie = false;

            $enabled = $config->get('cloudfront_signed_cookie.enabled', false);
            $domain = $config->get('cloudfront_signed_cookie.domain');
            $expires = (int) $config->get('cloudfront_signed_cookie.expires', 86400);
            $keyPairId = $config->get('cloudfront_signed_cookie.key_pair_id');
            $privateKeyFilename = $config->get('cloudfront_signed_cookie.private_key_filename');
            $profile = $config->get('cloudfront_signed_cookie.profile');
            $credentialsKey = $config->get('cloudfront_signed_cookie.credentials.key');
            $credentialsSecret = $config->get('cloudfront_signed_cookie.credentials.secret');

            if ($enabled && $expires && $keyPairId && $privateKeyFilename && ($profile || ($credentialsKey && $credentialsSecret))) {
                // Signed Cookie is enabled and we have the required config
                $shouldSetCookie = true;
            }

            if ($shouldSetCookie) {
                $u = $this->app->make(User::class);
                if (!$u->isRegistered()) {
                    /** @var CookieService $cookieService */
                    $cookieService = $this->app->make(CookieService::class);
                    $persistentCookie = $cookieService->getCookie();
                    if ($persistentCookie) {
                        // User is not logged in, but has a persistent cookie. This means verifying auth type cookie is not
                        // yet completed, but we couldn't get the user object because persistent cookie is not yet verified.
                        // So we need to get the user object from the persistent cookie.
                        $at = AuthenticationType::getByHandle($persistentCookie->getAuthenticationTypeHandle());
                        $_u = User::getByUserID($persistentCookie->getUserID());
                        if ($at && $at->controller->verifyHash($_u, $persistentCookie->getToken())) {
                            $u = $_u;
                        }
                    }
                }

                $key = Key::getByHandle('view_file_folder_file');
                $filesystem = new Filesystem();
                $folder = $filesystem->getRootFolder();
                $key->setPermissionObject($folder);
                $access = $key->getPermissionAccessObject();
                $entities = Entity::getForUser($u);
                if ($access && $entities) {
                    if (!$access->validateAccessEntities($entities)) {
                        // User does not have permission to view files, so we don't need to set the signed cookie
                        $shouldSetCookie = false;
                    }
                } else {
                    // If we can't get the permission access object or entities, we can't determine if the user has permission to view files
                    $shouldSetCookie = false;
                }
            }

            if ($shouldSetCookie) {
                if (!$domain) {
                    $domain = $request->getHost(); // Fallback to the current host
                }

                $args = [
                    'version' => 'latest',
                    'region' => 'us-east-1',
                ];
                if ($profile) {
                    $args['profile'] = $profile;
                } else {
                    $args['credentials'] = [
                        'key' => $credentialsKey,
                        'secret' => $credentialsSecret,
                    ];
                }
                $client = new CloudFrontClient($args);
                $expiresTimestamp = time() + $expires;
                $policy = $this->getPolicy($expiresTimestamp);
                try {
                    $results = $client->getSignedCookie([
                        'policy' => $policy,
                        'private_key' => $privateKeyFilename,
                        'key_pair_id' => $keyPairId,
                    ]);
                    foreach ($results as $key => $value) {
                        /**
                         * We need to set the same expiration time with the policy for all the cookies.
                         * @link https://docs.aws.amazon.com/AmazonCloudFront/latest/DeveloperGuide/private-content-signed-cookies.html#private-content-check-expiration-cookie
                         */
                        $cookieJar->getResponseCookies()->addCookie($key, $value, $expiresTimestamp, '/', $domain, true, true);
                    }
                } catch (AwsException $exception) {
                    /** @var LoggerFactory $loggerFactory */
                    $loggerFactory = $this->app->make('log/factory');
                    $logger = $loggerFactory->createLogger('s3_storage');
                    $logger->error($exception->getMessage());
                }
            }
        }

        return $frame->next($request);
    }

    /**
     * @param int $expires
     * @return string
     */
    protected function getPolicy($expires)
    {
        return <<<POLICY
{
    "Statement": [
        {
            "Resource": "https://*",
            "Condition": {
                "DateLessThan": {"AWS:EpochTime": {$expires}}
            }
        }
    ]
}
POLICY;
    }
}
