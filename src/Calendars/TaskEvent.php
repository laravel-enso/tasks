<?php

namespace LaravelEnso\Tasks\Calendars;

use Carbon\Carbon;
use LaravelEnso\Calendar\Contracts\Calendar;
use LaravelEnso\Calendar\Contracts\ProvidesEvent;
use LaravelEnso\Calendar\Contracts\Routable;
use LaravelEnso\Calendar\DTOs\Route;
use LaravelEnso\Calendar\Enums\Frequency;
use LaravelEnso\Tasks\Models\Task;

class TaskEvent implements ProvidesEvent, Routable
{
    public function __construct(private Task $task)
    {
    }

    public function getKey()
    {
        return $this->task->getKey();
    }

    public function title(): string
    {
        return $this->task->name;
    }

    public function body(): ?string
    {
        return $this->task->description;
    }

    public function start(): Carbon
    {
        return $this->task->reminder;
    }

    public function end(): Carbon
    {
        return $this->task->reminder->clone()->addHours(2);
    }

    public function location(): ?string
    {
        return null;
    }

    public function getCalendar(): Calendar
    {
        return new TaskCalendar();
    }

    public function frequency(): Frequency
    {
        return Frequency::Once;
    }

    public function recurrenceEnds(): ?Carbon
    {
        return null;
    }

    public function allDay(): bool
    {
        return false;
    }

    public function readonly(): bool
    {
        return true;
    }

    public function route(): Route
    {
        return new Route('tasks.edit', ['task' => $this->task->id]);
    }
}
