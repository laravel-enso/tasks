<?php

namespace LaravelEnso\Tasks\Enums;

use LaravelEnso\Enums\Services\Enum;

class Statuses extends Enum
{
    public const New = 1;
    public const InProgress = 2;
    public const Finished = 3;

    protected static array $data = [
        self::New => 'New',
        self::InProgress => 'In Progress',
        self::Finished => 'Finished',
    ];
}
