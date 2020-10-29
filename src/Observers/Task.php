<?php

namespace LaravelEnso\Tasks\Observers;

use Illuminate\Support\Facades\Event as EventFacade;
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

    private function dispatch($task)
    {
        EventFacade::dispatch(new Event($task));
    }
}
