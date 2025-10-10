<?php
defined('C5_EXECUTE') or die('Access Denied');

/** @var $configuration \S3Storage\S3Configuration */
if (is_object($configuration)) {
    $useIAM = $configuration->useIAM;
    $useACL = $configuration->useACL;
    $bucket = $configuration->bucket;
    $key = $configuration->key;
    $secret = $configuration->secret;
    $expire = $configuration->expire;
    $expire_enabled = $configuration->expire_enabled;
    $region = $configuration->region;
    $cache = $configuration->cache;
    $cacheEnabled = $configuration->cacheEnabled;
    if (!$region) {
        $region = 'us-east-1';
    }
    $base_url = $configuration->base_url;

    $region_help = h(t(
        'This required field is where you can specify a AWS region. ' .
        'eg: us-east-1, us-west-1, eu-west-1.'
    ));

    $expire_help = h(t(
        '<b>Note:</b> Bucket permissions must be configured properly for this to actually take effect. ' .
        'When enabled, you can enter any string accepted by %s. ' .
        'When not enabled, your bucket permissions must be configured to allow the public viewing of files. ' .
        'If you need some files to be restricted, I would suggest having two buckets and two storage locations.',
        '<a href="http://php.net/manual/en/function.strtotime.php">PHP\'s strtotime()</a>'
    ));

    $host_help = h(t(
        'This optional field is where you can specify a host to be used ' .
        '(such as a Cloudfront host) instead of the normal S3 hostname when generating asset URIs. ' .
        'This can only be used with non-expiring urls.'
    ));

    $cache_help = h(t(
        'If enabled this will add the CacheControl Header max age to all uploads. ' .
        'This will allow users to cache the files uploaded to s3, rather than re-downloading each visit.' .
        'Cache Expiry Time must be in seconds, eg. 300 seconds is 5 minutes and 604800 is 7 days.'
    ));

    $iam_help = h(t(
        'If you are using concreteCMS in an EC2 instance, you can use IAM roles instead of manually configuring.'
    ));

    $acl_help = h(t(
        'Turn this on if the ACL is enabled. Turn it off if you disable ACL and/or enable to block all public access from S3 permission.'
    ));

    $expire_args = array('placeholder' => t('Optional unless checked'));
    $expire_required = '';
    if (!$expire_enabled) {
        $expire_args['disabled'] = 'disabled';
        $expire_required = ' style="display:none"';
    }

    $hide_iam = '';
    if ($useIAM) {
        $hide_iam = ' style="display:none"';
    }
    /** @var \Concrete\Core\Form\Service\Form $form */
    $form = Core::make('helper/form'); ?>
    <div class="form-group">
        <label class="form-label" for="fslType[bucket]"><?php echo t('Bucket')?></label>
        <div class="input-group">
			<?php echo $form->text('fslType[bucket]', $bucket)?>
            <span class="input-group-addon input-group-text"><i class="fa fa-asterisk"></i></span>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="fslType[cacheEnabled]"><?php echo t('Cache Expiry Time')?></label>
        <i class="fa fa-question-circle" data-content="<?php echo $cache_help?>" data-toggle="popover" data-bs-content="<?php echo $cache_help?>" data-bs-toggle="popover"></i>
        <div class="input-group">
            <div class="input-group-addon input-group-text">
            <?php echo $form->checkbox('fslType[cacheEnabled]', 1, $cacheEnabled)?>
            </div>
            <?php echo $form->text('fslType[cache]', $cache, ['placeholder' => 604800, 'pattern' => '\d+', 'disabled' => $cacheEnabled ? 'false' : 'disabled'])?>
            <span class="input-group-addon input-group-text"><i class="fa fa-asterisk"></i></span>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="fslType[useIAM]"><?php echo t('Use IAM Roles')?></label>
        <i class="fa fa-question-circle" data-content="<?php echo $iam_help?>" data-toggle="popover" data-bs-content="<?php echo $iam_help?>" data-bs-toggle="popover"></i>
        <div class="input-group form-check form-switch">
			<?php echo $form->checkbox('fslType[useIAM]', 1, $useIAM);?>
        </div>
    </div>
    <div class="hide-iam"<?php echo $hide_iam;?>>
        <div class="form-group">
            <label class="form-label" for="fslType[key]"><?php echo t('Key')?></label>
            <div class="input-group">
				<?php echo $form->text('fslType[key]', $key)?>
                <span class="input-group-addon input-group-text"><i class="fa fa-asterisk"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="fslType[secret]"><?php echo t('Secret')?></label>
            <div class="input-group">
				<?php echo $form->text('fslType[secret]', $secret)?>
                <span class="input-group-addon input-group-text"><i class="fa fa-asterisk"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="fslType[region]"><?php echo t('AWS Region')?></label>
        <div class="input-group">
            <span class="input-group-addon input-group-text">
                <i class="fa fa-question-circle" data-content="<?php echo $region_help?>" data-toggle="popover" data-bs-content="<?php echo $region_help?>" data-bs-toggle="popover"></i>
            </span>
            <?php echo $form->text('fslType[region]', $region, array('placeholder' => 'us-east-1'))?>
            <span class="input-group-addon input-group-text"><i class="fa fa-asterisk"></i></span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="fslType[base_url]"><?php echo t('Alternate Host')?></label>
        <div class="input-group">
            <span class="input-group-addon input-group-text">
                <i class="fa fa-question-circle" data-content="<?php echo $host_help?>" data-toggle="popover" data-bs-content="<?php echo $host_help?>" data-bs-toggle="popover"></i>
            </span>
            <?php echo $form->text('fslType[base_url]', $base_url, array('placeholder' => t('Optional. E.g. http://s3.example.com')))?>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="fslType[expire]"><?php echo t('Link Expire Time')?></label>
        <i class="fa fa-question-circle" data-content="<?php echo $expire_help?>" data-toggle="popover" data-bs-content="<?php echo $expire_help?>" data-bs-toggle="popover"></i>
        <div class="input-group">
            <div class="input-group-addon input-group-text">
                <?php echo $form->checkbox('fslType[expire_enabled]', 1, $expire_enabled);?>
            </div>
            <?php echo $form->text('fslType[expire]', $expire, $expire_args)?>
            <span id="enabled_required" class="input-group-addon input-group-text"<?php echo $expire_required?>>
                <i class="fa fa-asterisk"></i>
            </span>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="fslType[useACL]"><?php echo t('Use ACL')?></label>
        <i class="fa fa-question-circle" data-content="<?php echo $acl_help?>" data-toggle="popover" data-bs-content="<?php echo $acl_help?>" data-bs-toggle="popover"></i>
        <div class="input-group form-check form-switch">
            <?php echo $form->checkbox('fslType[useACL]', 1, $useACL);?>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="popover"]').popover({ trigger: "hover", html: true })
        })
        $("input[name='fslType[expire_enabled]']").on("click", function() {
            if(!this.checked) {
                $("input[name='fslType[expire]']").prop('disabled', true);
                $("input[name='fslType[base_url]']").prop('disabled', false);
                $("#enabled_required").hide();
            } else {
                $("input[name='fslType[expire]']").prop('disabled', false);
                $("input[name='fslType[base_url]']").prop('disabled', true);
                $("#enabled_required").show();
            }
        });
        $("input[name='fslType[useIAM]']").on("click", function() {
            if(!this.checked) {
                $(".hide-iam").show();
            } else {
                $(".hide-iam").hide();
            }
        });
        $("input[name='fslType[cacheEnabled]']").on("click", function() {
            if(!this.checked) {
                $("input[name='fslType[cache]']").prop('disabled', true);
                $("cache-time").hide();
            } else {
                $("cache-time").show();
                $("input[name='fslType[cache]']").prop('disabled', false);
            }
        });
    </script>

	<?php
}
