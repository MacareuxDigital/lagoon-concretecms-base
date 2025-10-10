<?php return array(
    'root' => array(
        'name' => 'mnkras/concrete5-s3_storage',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => 'd7867b07b0d4c208c2646e3942c4b11388d057bf',
        'type' => 'concrete5-package',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => false,
    ),
    'versions' => array(
        'aws/aws-crt-php' => array(
            'pretty_version' => 'v1.2.4',
            'version' => '1.2.4.0',
            'reference' => 'eb0c6e4e142224a10b08f49ebf87f32611d162b2',
            'type' => 'library',
            'install_path' => __DIR__ . '/../aws/aws-crt-php',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'aws/aws-sdk-php' => array(
            'pretty_version' => '3.304.4',
            'version' => '3.304.4.0',
            'reference' => '20be41a5f1eef4c8a53a6ae7c0fc8b7346c0c386',
            'type' => 'library',
            'install_path' => __DIR__ . '/../aws/aws-sdk-php',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'guzzlehttp/guzzle' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'guzzlehttp/promises' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'guzzlehttp/psr7' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'league/flysystem' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '1.0.*',
            ),
        ),
        'league/flysystem-aws-s3-v3' => array(
            'pretty_version' => '1.0.30',
            'version' => '1.0.30.0',
            'reference' => 'af286f291ebab6877bac0c359c6c2cb017eb061d',
            'type' => 'library',
            'install_path' => __DIR__ . '/../league/flysystem-aws-s3-v3',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'mnkras/concrete5-s3_storage' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => 'd7867b07b0d4c208c2646e3942c4b11388d057bf',
            'type' => 'concrete5-package',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'mtdowling/jmespath.php' => array(
            'pretty_version' => '2.7.0',
            'version' => '2.7.0.0',
            'reference' => 'bbb69a935c2cbb0c03d7f481a238027430f6440b',
            'type' => 'library',
            'install_path' => __DIR__ . '/../mtdowling/jmespath.php',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'psr/http-message' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'symfony/polyfill-mbstring' => array(
            'pretty_version' => 'v1.29.0',
            'version' => '1.29.0.0',
            'reference' => '9773676c8a1bb1f8d4340a62efe641cf76eda7ec',
            'type' => 'library',
            'install_path' => __DIR__ . '/../symfony/polyfill-mbstring',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
