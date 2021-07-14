<?php

namespace Vanthao03596\LaravelGhtk\Tests;

use Http\Client\Common\HttpMethodsClientInterface;
use InvalidArgumentException;
use Vanthao03596\GhtkSdk\Client;
use Vanthao03596\LaravelGhtk\Auth\AuthenticatorFactory;
use Vanthao03596\LaravelGhtk\GhtkFactory;

class GhtkFactoryTest extends TestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getFactory();

        $client = $factory[0]->make(['token' => 'your-token', 'method' => 'token', 'live_mode' => false]);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertInstanceOf(HttpMethodsClientInterface::class, $client->getHttpClient());
    }

    public function testMakeInvalidMethod()
    {
        $factory = $this->getFactory();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported authentication method [bar].');

        $factory[0]->make(['method' => 'bar']);
    }

    public function testMakeEmpty()
    {
        $factory = $this->getFactory();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The Ghtk factory requires an auth method.');

        $factory[0]->make([]);
    }

    protected function getFactory()
    {
        return [new GhtkFactory(new AuthenticatorFactory())];
    }
}
