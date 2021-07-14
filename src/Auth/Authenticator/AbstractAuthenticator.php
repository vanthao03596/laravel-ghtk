<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelGhtk\Auth\Authenticator;

use Vanthao03596\GhtkSdk\Client;

abstract class AbstractAuthenticator implements AuthenticatorInterface
{
    /**
     * The client to perform the authentication on.
     *
     * @var \Vanthao03596\GhtkSdk\Client|null
     */
    protected $client;

    /**
     * Set the client to perform the authentication on.
     *
     * @param \Vanthao03596\GhtkSdk\Client $client
     *
     * @return \Vanthao03596\LaravelGhtk\Auth\Authenticator\AuthenticatorInterface
     */
    public function with(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
