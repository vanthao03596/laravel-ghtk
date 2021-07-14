<?php

declare(strict_types=1);


namespace Vanthao03596\LaravelGhtk\Auth\Authenticator;

use InvalidArgumentException;

final class TokenAuthenticator extends AbstractAuthenticator
{
    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Vanthao03596\GhtkSdk\Client
     */
    public function authenticate(array $config)
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the authenticator.');
        }

        if (!array_key_exists('token', $config)) {
            throw new InvalidArgumentException('The token authenticator requires a token.');
        }

        $this->client->authenticate($config['token']);

        return $this->client;
    }
}