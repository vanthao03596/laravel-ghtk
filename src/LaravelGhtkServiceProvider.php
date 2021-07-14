<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelGhtk;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Vanthao03596\GhtkSdk\Client;
use Vanthao03596\LaravelGhtk\Auth\AuthenticatorFactory;

class LaravelGhtkServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->setupConfig();
    }

    protected function setupConfig()
    {
        $source = realpath($raw = __DIR__.'/../config/ghtk.php') ?: $raw;

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => config_path('ghtk.php')]);
        }

        $this->mergeConfigFrom($source, 'ghtk');
    }

    public function register()
    {
        $this->registerAuthFactory();
        $this->registerDigitalOceanFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    protected function registerAuthFactory()
    {
        $this->app->singleton('ghtk.authfactory', function () {
            return new AuthenticatorFactory();
        });

        $this->app->alias('ghtk.authfactory', AuthenticatorFactory::class);
    }

    protected function registerDigitalOceanFactory()
    {
        $this->app->singleton('ghtk.factory', function (Container $app) {
            $auth = $app['ghtk.authfactory'];

            return new GhtkFactory($auth);
        });

        $this->app->alias('ghtk.factory', GhtkFactory::class);
    }

    protected function registerManager()
    {
        $this->app->singleton('ghtk', function (Container $app) {
            $config = $app['config'];
            $factory = $app['ghtk.factory'];

            return new GhtkManager($config, $factory);
        });

        $this->app->alias('ghtk', GhtkManager::class);
    }

    protected function registerBindings()
    {
        $this->app->bind('ghtk.connection', function (Container $app) {
            $manager = $app['ghtk'];

            return $manager->connection();
        });

        $this->app->alias('ghtk.connection', Client::class);
    }

    public function provides()
    {
        return [
            'ghtk.authfactory',
            'ghtk.factory',
            'ghtk',
            'ghtk.connection',
        ];
    }
}
