<?php

namespace LaravelEnso\Tasks\Enums;

use LaravelEnso\Enums\Contracts\Frontend;
use LaravelEnso\Enums\Traits\Enum;

enum Flag: int implements Frontend
{
    use Enum;

    public const Danger = 1;
    public const Warning = 2;
    public const Info = 3;
    public const Success = 4;

    public static function registerBy(): string
    {
        return 'flag';
    }
}
