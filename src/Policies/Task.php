<?php

namespace LaravelEnso\Tasks\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Tasks\Models\Task as Model;

class Task
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
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
