<?php

namespace Vanthao03596\LaravelGhtk\Tests\Auth\Authenticator;

use InvalidArgumentException;
use Mockery;
use Vanthao03596\GhtkSdk\Client;
use Vanthao03596\LaravelGhtk\Auth\Authenticator\TokenAuthenticator;
use Vanthao03596\LaravelGhtk\Tests\TestCase;

class TokenAuthenticatorTest extends TestCase
{
    public function testMakeWithMethod()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')->once()->with('your-token');

        $return = $authenticator->with($client)->authenticate([
            'token' => 'your-token',
            'method' => 'token',
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    public function testMakeWithoutMethod()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);
        $client->shouldReceive('authenticate')->once()->with('your-token');

        $return = $authenticator->with($client)->authenticate([
            'token' => 'your-token',
        ]);

        $this->assertInstanceOf(Client::class, $return);
    }

    public function testMakeWithoutToken()
    {
        $authenticator = $this->getAuthenticator();

        $client = Mockery::mock(Client::class);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The token authenticator requires a token.');

        $authenticator->with($client)->authenticate([]);
    }

    public function testMakeWithoutSettingClient()
    {
        $authenticator = $this->getAuthenticator();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The client instance was not given to the authenticator.');

        $authenticator->authenticate([
            'token' => 'your-token',
            'method' => 'token',
        ]);
    }

    protected function getAuthenticator()
    {
        return new TokenAuthenticator();
    }
}
