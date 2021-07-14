<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelGhtk;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the ghtk manager class.
 *
 * @method void                                           authenticate(string $token)
 * @method \Psr\Http\Message\ResponseInterface|null       getLastResponse()
 * @method \Http\Client\Common\HttpMethodsClientInterface getHttpClient()
 *
 */
class GhtkManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Vanthao03596\LaravelGhtk\GhtkFactory
     */
    protected $factory;

    /**
     * Create a new digitalocean manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository          $config
     * @param \Vanthao03596\LaravelGhtk\GhtkFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, GhtkFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Vanthao03596\GhtkSdk\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'ghtk';
    }

    /**
     * Get the factory instance.
     *
     * @return \Vanthao03596\LaravelGhtk\GhtkFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
