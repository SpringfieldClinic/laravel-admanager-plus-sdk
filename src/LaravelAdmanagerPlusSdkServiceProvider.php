<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use SpringfieldClinic\LaravelAdmanagerPlusSdk\Commands\LaravelAdmanagerPlusSdkCommand;

class LaravelAdmanagerPlusSdkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-admanager-plus-sdk')
            ->hasConfigFile()
            ->hasCommand(LaravelAdmanagerPlusSdkCommand::class)
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile();
            });
    }
}
