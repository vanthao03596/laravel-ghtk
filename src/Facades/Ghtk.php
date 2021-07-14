<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelGhtk\Facades;

use Illuminate\Support\Facades\Facade;

class Ghtk extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ghtk';
    }
}
