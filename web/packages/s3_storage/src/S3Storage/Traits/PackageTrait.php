<?php

namespace S3Storage\Traits;

use Concrete\Core\Config\Repository\Liaison;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Support\Facade\Application;

trait PackageTrait
{
    protected $packageConfig = null;

    /**
     * @return \Concrete\Core\Config\Repository\Liaison|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getPackageConfig()
    {
        if (!$this->packageConfig) {
            $app = Application::getFacadeApplication();
            /** @var PackageService $packageService */
            $packageService = $app->make(PackageService::class);
            $package = $packageService->getClass('s3_storage');
            if ($package) {
                $this->packageConfig = $package->getFileConfig();
            }
        }

        return $this->packageConfig;
    }
}
