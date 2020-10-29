<?php

namespace LaravelEnso\Tasks\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Tasks\Http\Responses\TaskCount;

class Task implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->queue = 'notifications';
    }

    public function broadcastOn()
    {
        return new PrivateChannel("tasks.{$this->user->id}");
    }

    public function broadcastWith()
    {
        return (new TaskCount($this->user))->toResponse();
    }

    public function broadcastAs()
    {
        return 'tasks-changed';
    }
}
