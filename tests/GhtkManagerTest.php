<?php

namespace Vanthao03596\LaravelGhtk\Tests;

use Illuminate\Contracts\Config\Repository;
use Mockery;
use Vanthao03596\GhtkSdk\Client;
use Vanthao03596\LaravelGhtk\GhtkFactory;
use Vanthao03596\LaravelGhtk\GhtkManager;

class GhtkManagerTest extends TestCase
{
    public function testCreateConnection()
    {
        $config = ['token' => 'your-token'];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('ghtk.default')->andReturn('main');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Client::class, $return);

        $this->assertArrayHasKey('main', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(GhtkFactory::class);

        $manager = new GhtkManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('ghtk.connections')->andReturn(['main' => $config]);

        $config['name'] = 'main';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));

        return $manager;
    }
}
