<?php

namespace LaravelEnso\Tasks\Enums;


enum Flag: int
{
    case Danger = 1;
    case Warning = 2;
    case Info = 3;
    case Success = 4;
}
