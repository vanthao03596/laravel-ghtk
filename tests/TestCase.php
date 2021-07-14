<?php

namespace Vanthao03596\LaravelGhtk\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Vanthao03596\LaravelGhtk\LaravelGhtkServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelGhtkServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
