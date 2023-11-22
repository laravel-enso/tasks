<?php

namespace LaravelEnso\Tasks\Dynamics;

use Closure;
use LaravelEnso\DynamicMethods\Contracts\Method;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Users\Models\User;

class Tasks implements Method
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
        return fn (User $user) => $user->hasMany(Task::class, 'allocated_to');
    }
}
