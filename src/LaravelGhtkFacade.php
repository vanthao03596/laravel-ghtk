<?php

namespace Vanthao03596\LaravelGhtk;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vanthao03596\LaravelGhtk\LaravelGhtk
 */
class LaravelGhtkFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-ghtk';
    }
}
