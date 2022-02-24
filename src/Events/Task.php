<?php

namespace LaravelEnso\Tasks\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use LaravelEnso\Tasks\Http\Responses\TaskCount;
use LaravelEnso\Users\Models\User;

class Task implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(private int $userId)
    {
        $this->queue = 'notifications';
    }

    public function broadcastOn()
    {
        return new PrivateChannel("tasks.{$this->userId}");
    }

    public function broadcastWith()
    {
        return (new TaskCount(User::find($this->userId)))->data();
    }

    public function broadcastAs()
    {
        return 'updated';
    }
}
