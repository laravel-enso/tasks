<?php

namespace LaravelEnso\Tasks\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use LaravelEnso\Core\Models\User;

class TaskCount implements Responsable
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function toResponse($request = null)
    {
        return [
            'overdueCount' => $this->user->allocatedTasks()->overdue()->count(),
            'pendingCount' => $this->user->allocatedTasks()->pending()->count(),
        ];
    }
}
