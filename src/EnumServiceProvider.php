<?php

namespace LaravelEnso\Tasks;

use LaravelEnso\Enums\EnumServiceProvider as ServiceProvider;
use LaravelEnso\Tasks\Enums\Flags;
use LaravelEnso\Tasks\Enums\Statuses;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'flags' => Flags::class,
        'Statuses' => Statuses::class,
    ];
}
