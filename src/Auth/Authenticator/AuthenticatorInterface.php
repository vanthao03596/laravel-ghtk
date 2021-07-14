<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelGhtk\Auth\Authenticator;

use Vanthao03596\GhtkSdk\Client;

interface AuthenticatorInterface
{
    /**
     * Set the client to perform the authentication on.
     *
     * @param \Vanthao03596\GhtkSdk\Client $client
     *
     * @return \Vanthao03596\LaravelGhtk\Auth\Authenticator\AuthenticatorInterface
     */
    public function with(Client $client);

    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Vanthao03596\GhtkSdk\Client
     */
    public function authenticate(array $config);
}