<?php

namespace LaravelEnso\Tasks\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use LaravelEnso\Tasks\Http\Responses\TaskCount;
use LaravelEnso\Tasks\Models\Task as Model;

class Task implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Model $task;

    public function __construct($task)
    {
        $this->task = $task;
        $this->queue = 'notifications';
    }

    public function broadcastOn()
    {
        return new PrivateChannel("tasks.{$this->task->allocated_to}");
    }

    public function broadcastWith()
    {
        return (new TaskCount($this->task->allocatedTo))->toResponse();
    }

    public function broadcastAs()
    {
        return 'tasks-changed';
    }
}
