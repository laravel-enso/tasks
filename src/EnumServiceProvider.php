<?php

namespace LaravelEnso\Tasks;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\Tasks\Enums\Flags;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'flags' => Flags::class,
    ];
}
