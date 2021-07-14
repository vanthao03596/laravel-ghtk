<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelGhtk\Auth;

use InvalidArgumentException;

class AuthenticatorFactory
{
    /**
     * Make a new authenticator instance.
     *
     * @param string $method
     *
     * @throws \InvalidArgumentException
     *
     * @return \Vanthao03596\LaravelGhtk\Auth\Authenticator\AuthenticatorInterface
     */
    public function make(string $method)
    {
        switch ($method) {
            case 'token':
                return new Authenticator\TokenAuthenticator();
        }

        throw new InvalidArgumentException("Unsupported authentication method [$method].");
    }
}