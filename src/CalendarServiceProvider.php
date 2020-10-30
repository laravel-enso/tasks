<?php

namespace LaravelEnso\Tasks;

use LaravelEnso\Calendar\CalendarServiceProvider as BaseProvider;
use LaravelEnso\Tasks\Calendars\TaskCalendar;

class CalendarServiceProvider extends BaseProvider
{
    protected $register = [TaskCalendar::class];
}
