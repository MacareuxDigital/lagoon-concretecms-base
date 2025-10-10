<?php

namespace Concrete\Package\S3Storage\Controller\SinglePage\Dashboard\System\Files;

use Concrete\Core\Page\Controller\DashboardPageController;
use S3Storage\Traits\PackageTrait;

class CloudfrontSignedCookie extends DashboardPageController
{
    use PackageTrait;

    public function view()
    {
        $config = $this->getPackageConfig();
        if ($config) {
            $this->set('enabled', $config->get('cloudfront_signed_cookie.enabled', false));
            $this->set('domain', $config->get('cloudfront_signed_cookie.domain'));
            $this->set('expires', $config->get('cloudfront_signed_cookie.expires', 86400));
            $this->set('key_pair_id', $config->get('cloudfront_signed_cookie.key_pair_id'));
            $this->set('private_key_filename', $config->get('cloudfront_signed_cookie.private_key_filename'));
            $this->set('profile', $config->get('cloudfront_signed_cookie.profile'));
            $this->set('credentials_key', $config->get('cloudfront_signed_cookie.credentials.key'));
            $this->set('credentials_secret', $config->get('cloudfront_signed_cookie.credentials.secret'));
        }

        $this->set('pageTitle', t('CloudFront Signed Cookie Settings'));
    }

    public function save()
    {
        if (!$this->token->validate('cloudfront_signed_cookie_save')) {
            $this->error->add($this->token->getErrorMessage());
        }

        $enabled = (bool) $this->request->request->get('enabled');
        $domain = $this->request->request->get('domain');

        $expires = (int) $this->request->request->get('expires');
        if ($enabled && $expires < 1) {
            $this->error->add(t('Expires must be greater than 0'));
        }

        $key_pair_id = $this->request->request->get('key_pair_id');
        if ($enabled && !$key_pair_id) {
            $this->error->add(t('Key Pair ID is required'));
        }

        $private_key_filename = $this->request->request->get('private_key_filename');
        if ($enabled) {
            if ($private_key_filename) {
                if (!is_readable($private_key_filename)) {
                    $this->error->add(t('Private Key Filename is not readable'));
                }
            } else {
                $this->error->add(t('Private Key Filename is required'));
            }
        }

        $profile = $this->request->request->get('profile');
        $credentials_key = $this->request->request->get('credentials_key');
        $credentials_secret = $this->request->request->get('credentials_secret');
        if ($enabled) {
            if (!$profile && (!$credentials_key || !$credentials_secret)) {
                $this->error->add(t('Profile or Credentials are required'));
            }
        }

        if (!$this->error->has()) {
            $config = $this->getPackageConfig();
            if ($config) {
                $config->save('cloudfront_signed_cookie.enabled', $enabled);
                $config->save('cloudfront_signed_cookie.domain', $domain);
                $config->save('cloudfront_signed_cookie.expires', $expires);
                $config->save('cloudfront_signed_cookie.key_pair_id', $key_pair_id);
                $config->save('cloudfront_signed_cookie.private_key_filename', $private_key_filename);
                $config->save('cloudfront_signed_cookie.profile', $profile);
                $config->save('cloudfront_signed_cookie.credentials.key', $credentials_key);
                $config->save('cloudfront_signed_cookie.credentials.secret', $credentials_secret);
            }
            $this->flash('success', t('Cloudfront Signed Cookie settings saved successfully.'));

            return $this->buildRedirect($this->action('view'));
        } else {
            $this->view();
        }
    }
}
