<?php

namespace Totov\Cap;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Totov\Cap\Commands\CapCommand;

class CapServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-cap-hpi')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-cap-hpi_table')
            ->hasCommand(CapCommand::class);
    }
}
