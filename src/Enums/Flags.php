<?php

namespace LaravelEnso\Tasks\Enums;

use LaravelEnso\Enums\Services\Enum;

class Flags extends Enum
{
    public const Info = 1;
    public const Success = 2;
    public const Warning = 3;
    public const Danger = 4;
}
