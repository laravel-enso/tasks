<?php

namespace LaravelEnso\Tasks\Dynamics;

use Closure;
use LaravelEnso\DynamicMethods\Contracts\Relation;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Users\Models\User;

class Tasks implements Relation
{
    public function bindTo(): array
    {
        return [User::class];
    }

    public function name(): string
    {
        return 'tasks';
    }

    public function closure(): Closure
    {
        return fn (User $model) => $model->hasMany(Task::class, 'allocated_to');
    }
}
