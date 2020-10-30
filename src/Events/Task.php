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

    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->queue = 'notifications';
    }

    public function broadcastOn()
    {
        return new PrivateChannel("tasks.{$this->userId}");
    }

    public function broadcastWith()
    {
        return (new TaskCount(User::find($this->userId)))->toResponse();
    }

    public function broadcastAs()
    {
        return 'tasks-changed';
    }
}
