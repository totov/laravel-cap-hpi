<?php

namespace Totov\Cap;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile('cap');

        $this->app->singleton(Cap::class, function () {

            $clientId = config('cap.client_id');
            $secret = config('cap.secret');

            return new Cap($clientId, $secret);
        });
    }
}
