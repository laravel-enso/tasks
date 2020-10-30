<?php

namespace LaravelEnso\Tasks\Calendars;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use LaravelEnso\Calendar\Contracts\CustomCalendar;
use LaravelEnso\Calendar\Enums\Colors;
use LaravelEnso\Tasks\Models\Task;

class TaskCalendar implements CustomCalendar
{
    public function getKey()
    {
        return 'task-calendar';
    }

    public function name(): string
    {
        return 'Tasks';
    }

    public function color(): string
    {
        return Colors::Red;
    }

    public function private(): bool
    {
        return false;
    }

    public function readonly(): bool
    {
        return true;
    }

    public function events(Carbon $startDate, Carbon $endDate): Collection
    {
        return Task::allowed()
            ->whereBetween('reminder', [$startDate, $endDate])->get()
            ->map(fn ($task) => new TaskEvent($task));
    }
}
