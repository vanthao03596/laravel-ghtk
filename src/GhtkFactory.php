
<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelGhtk;

use Vanthao03596\GhtkSdk\Client;
use Vanthao03596\LaravelGhtk\Auth\AuthenticatorFactory;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class GhtkFactory
{
    /**
     * The authenticator factory instance.
     *
     * @var \Vanthao03596\LaravelGhtk\Auth\AuthenticatorFactory
     */
    protected $auth;

    /**
     * Create a new DigitalOcean factory instance.
     *
     * @param \Vanthao03596\LaravelGhtk\Auth\AuthenticatorFactory $auth
     *
     * @return void
     */
    public function __construct(AuthenticatorFactory $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Make a new Ghtk client.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Vanthao03596\GhtkSdk\Client
     */
    public function make(array $config)
    {
        $liveMode = Arr::get($config, 'live_mode', true);

        $client = new Client(null, $liveMode);

        if (!array_key_exists('method', $config)) {
            throw new InvalidArgumentException('The Ghtk factory requires an auth method.');
        }

        return $this->auth->make($config['method'])->with($client)->authenticate($config);
    }
}