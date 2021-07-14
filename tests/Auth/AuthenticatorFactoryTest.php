<?php

namespace Vanthao03596\LaravelGhtk\Tests\Auth;

use InvalidArgumentException;
use TypeError;
use Vanthao03596\LaravelGhtk\Auth\Authenticator\TokenAuthenticator;
use Vanthao03596\LaravelGhtk\Auth\AuthenticatorFactory;
use Vanthao03596\LaravelGhtk\Tests\TestCase;

class AuthenticatorFactoryTest extends TestCase
{
    public function testMakeTokenAuthenticator()
    {
        $return = $this->getFactory()->make('token');

        $this->assertInstanceOf(TokenAuthenticator::class, $return);
    }

    public function testMakeInvalidAuthenticator()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported authentication method [foo].');

        $this->getFactory()->make('foo');
    }

    public function testMakeNoAuthenticator()
    {
        $this->expectException(TypeError::class);

        $this->getFactory()->make(null);
    }

    protected function getFactory()
    {
        return new AuthenticatorFactory();
    }
}
