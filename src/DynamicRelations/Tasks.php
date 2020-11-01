<?php

namespace LaravelEnso\Tasks\DynamicRelations;

use Closure;
use LaravelEnso\DynamicMethods\Contracts\Method;
use LaravelEnso\Tasks\Models\Task;

class Tasks implements Method
{
    public function name(): string
    {
        return 'tasks';
    }

    public function closure(): Closure
    {
        return fn () => $this->hasMany(Task::class, 'allocated_to');
    }
}
