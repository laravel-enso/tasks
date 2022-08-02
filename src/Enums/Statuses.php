<?php

namespace LaravelEnso\Tasks\Enums;

use LaravelEnso\Enums\Services\Enum;

class Statuses extends Enum
{
    public const New = 1;
    public const Progress = 2;
    public const Finished = 3;
}
