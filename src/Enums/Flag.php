<?php

namespace LaravelEnso\Tasks\Enums;

use LaravelEnso\Enums\Contracts\Frontend;

enum Flag: int implements Frontend
{
    case Danger = 1;
    case Warning = 2;
    case Info = 3;
    case Success = 4;

    public static function registerBy(): string
    {
        return 'flags';
    }
}
