<?php

namespace Vanthao03596\LaravelGhtk\Commands;

use Illuminate\Console\Command;

class LaravelGhtkCommand extends Command
{
    public $signature = 'laravel-ghtk';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
