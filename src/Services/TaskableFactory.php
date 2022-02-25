<?php

namespace LaravelEnso\Tasks\Services;

use LaravelEnso\Tasks\Contracts\Taskable;
use LaravelEnso\Tasks\Models\Task;

class TaskableFactory
{
    public function create(Taskable $taskable): Task
    {
        return Task::create([
            'name'         => $taskable->name(),
            'description'  => $taskable->description(),
            'allocated_to' => $taskable->allocatedTo()?->id,
            'flag'         => $taskable->flag(),
            'reminder'     => $taskable->reminder(),
            'completed'    => $taskable->completed(),
            'created_by'   => $taskable->createdBy()?->id,
            'updated_by'   => $taskable->updatedBy()?->id,
        ]);
    }
}
