<?php

namespace LaravelEnso\Tasks\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Tasks\Models\Task;

class TaskPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
    }

    public function handle(User $user, Task $task)
    {
        return $user->id === $task->created_by;
    }
}
