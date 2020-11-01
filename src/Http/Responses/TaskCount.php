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

    public function toResponse($request)
    {
        return $this->data();
    }

    public function data()
    {
        return [
            'overdueCount' => $this->user->tasks()->overdue()->count(),
            'pendingCount' => $this->user->tasks()->pending()->count(),
        ];
    }
}
