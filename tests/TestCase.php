<?php

namespace Totov\Cap\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Totov\Cap\CapServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            CapServiceProvider::class,
        ];
    }
}
