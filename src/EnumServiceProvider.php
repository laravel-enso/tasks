<?php

namespace LaravelEnso\Tasks;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\Tasks\Enums\Flag;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'flag' => Flag::class,
    ];
}
