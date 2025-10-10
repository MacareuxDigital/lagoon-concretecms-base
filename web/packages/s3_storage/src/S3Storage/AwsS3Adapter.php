<?php
/**
 * @author: Biplob Hossain <biplob.ice@gmail.com>
 */

namespace S3Storage;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;

/**
 * Class AwsS3Adapter
 * This class is used to override the AwsS3Adapter in order to support default value of ACL.
 * @see https://github.com/thephpleague/flysystem/issues/1580
 * @package S3Storage
 */
class AwsS3Adapter extends \League\Flysystem\AwsS3v3\AwsS3Adapter
{
    const ACL_BUCKET_OWNER_FULL_CONTROL = 'bucket-owner-full-control';

    /**
     * @inheritdoc
     */
    protected function getOptionsFromConfig(Config $config)
    {
        $options = $this->options;

        if ($visibility = $config->get('visibility')) {
            // For local reference
            $options['visibility'] = $visibility;
            // For external reference
            if ($options['ACL'] !== self::ACL_BUCKET_OWNER_FULL_CONTROL) {
                $options['ACL'] = $visibility === AdapterInterface::VISIBILITY_PUBLIC ? 'public-read' : 'private';
            }
        }

        if ($mimetype = $config->get('mimetype')) {
            // For local reference
            $options['mimetype'] = $mimetype;
            // For external reference
            $options['ContentType'] = $mimetype;
        }

        foreach (static::$metaOptions as $option) {
            if (! $config->has($option)) {
                continue;
            }
            $options[$option] = $config->get($option);
        }

        return $options;
    }
}
