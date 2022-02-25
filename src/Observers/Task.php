<?php

namespace LaravelEnso\Tasks\Observers;

use Illuminate\Support\Facades\Event as Facade;
use LaravelEnso\Tasks\Events\Task as Event;
use LaravelEnso\Tasks\Models\Task as Model;

class Task
{
    public function created(Model $task)
    {
        $this->dispatch($task);
    }

    public function updated(Model $task)
    {
        $this->dispatch($task);
    }

    public function deleted(Model $task)
    {
        $this->dispatch($task);
    }

    private function dispatch(Model $task)
    {
        Facade::dispatch(new Event($task->allocated_to));

        if (!$task->wasRecentlyCreated && $task->isDirty('allocated_to')) {
            Facade::dispatch(new Event($task->getOriginal('allocated_to')));
        }
    }
}
