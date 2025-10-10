<?php
defined('C5_EXECUTE') or die("Access Denied.");
/** @var \Concrete\Core\Form\Service\Form $form */
/** @var \Concrete\Core\Validation\CSRF\Token $token */
/** @var \Concrete\Core\View\View $view */

$enabled = isset($enabled) ? $enabled : false;
$resource = isset($resource) ? $resource : '';
$expires = isset($expires) ? $expires : null;
$domain = isset($domain) ? $domain : '';
$key_pair_id = isset($key_pair_id) ? $key_pair_id : '';
$private_key_filename = isset($private_key_filename) ? $private_key_filename : '';
$profile = isset($profile) ? $profile : 'default';
$credentials_key = isset($credentials_key) ? $credentials_key : '';
$credentials_secret = isset($credentials_secret) ? $credentials_secret : '';
$useProfile = !($credentials_key || $credentials_secret);
?>
<form action="<?= $view->action('save') ?>" method="post">
    <?php $token->output('cloudfront_signed_cookie_save') ?>

    <p><?= t('CloudFront signed cookies allow you to control who can access your files on CloudFront. It is helpful if you want to restrict access to your files to only logged-in users.') ?></p>
    <p><?= t('Signed cookies will give users access to the entire S3 bucket, but it works well with block cache. It is best for intranet sites because you may want to block access from anonymous users but keep the website fast.') ?></p>
    <p><?= t('If you want to restrict access to individual files, consider setting Link Expire Time in S3 Storage Settings. However, you have to disable block cache when you use signed URLs.') ?></p>

    <div class="form-group">
        <div class="form-check form-switch">
            <?= $form->checkbox('enabled', 1, $enabled) ?>
            <?= $form->label('enabled', t('CloudFront Signed Cookies Enabled')) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->label('domain', t('Cookie Domain')) ?>
        <?= $form->text('domain', $domain) ?>
        <div class="help-block">
            <?= t('The domain name of your website. For example, if you set example.com, the signed cookies are available to all subdomains of example.com like files.example.com.') ?>
    </div>

    <div class="form-group">
        <?= $form->label('expires', t('Expires')) ?>
        <?= $form->number('expires', $expires, ['min' => 1, 'placeholder' => 86400]) ?>
    </div>

    <div class="form-group">
        <?= $form->label('key_pair_id', t('Key Pair ID')) ?>
        <?= $form->text('key_pair_id', $key_pair_id) ?>
    </div>

    <div class="form-group">
        <?= $form->label('private_key_filename', t('Private Key Filename')) ?>
        <?= $form->text('private_key_filename', $private_key_filename) ?>
    </div>

    <div class="form-group">
        <div class="form-check form-switch">
            <?= $form->checkbox('useProfile', 1, $useProfile) ?>
            <?= $form->label('useProfile', t('Use Profile')) ?>
        </div>
    </div>

    <div id="profile"<?php if (!$useProfile) { ?> style="display: none"<?php } ?>>
        <div class="form-group">
            <?= $form->label('profile', t('Profile')) ?>
            <?= $form->text('profile', $profile) ?>
        </div>
    </div>

    <div id="credential_keys"<?php if ($useProfile) { ?> style="display: none"<?php } ?>>
        <div class="form-group">
            <?= $form->label('credentials_key', t('Credentials Key')) ?>
            <?= $form->text('credentials_key', $credentials_key) ?>
        </div>
        <div class="form-group">
            <?= $form->label('credentials_secret', t('Credentials Secret')) ?>
            <div class="input-group">
                <?= $form->password('credentials_secret', $credentials_secret) ?>
                <button id="show_key" class="btn btn-outline-secondary"
                        title="<?= t('Show secret key') ?>">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button type="submit" class="btn btn-primary float-end">
                <?php echo t('Save') ?>
            </button>
        </div>
    </div>
</form>
<script>
    $('#useProfile').on('change', function () {
        if ($(this).is(':checked')) {
            $('#profile').show();
            $('#credential_keys').hide();
        } else {
            $('#profile').hide();
            $('#credential_keys').show();
        }
    });
    $('#show_key').on('click', function (e) {
        e.preventDefault();
        let keyField = $('#credentials_secret');
        if (keyField.attr('type') === 'password') {
            keyField.attr('type', 'text');
            $('#show_key')
                .attr('title', <?= json_encode(t('Hide secret key')) ?>)
                .html('<i class="fas fa-eye-slash"></i>')
            ;
        } else {
            keyField.attr('type', 'password');
            $('#show_key')
                .attr('title', <?= json_encode(t('Show secret key')) ?>)
                .html('<i class="fas fa-eye"></i>')
            ;
        }
    });
</script>