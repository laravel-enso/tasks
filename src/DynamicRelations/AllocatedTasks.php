<?php

namespace LaravelEnso\Tasks\DynamicRelations;

use Closure;
use LaravelEnso\DynamicMethods\Contracts\Method;
use LaravelEnso\Tasks\Models\Task;

class AllocatedTasks implements Method
{
    public function name(): string
    {
        return 'allocatedTasks';
    }

    public function closure(): Closure
    {
        return fn () => $this->hasMany(Task::class, 'allocated_to')
            ->whereCompleted(false);
    }
}
