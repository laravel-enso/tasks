<?php

namespace LaravelEnso\Tasks\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelEnso\Tasks\Models\Task as Model;
use LaravelEnso\Users\Models\User;

class Task
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isSuperior();
    }

    public function handle(User $user, Model $task)
    {
        return $user->id === $task->created_by;
    }

    public function allocate()
    {
        return false;
    }
}
