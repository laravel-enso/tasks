<?php

namespace LaravelEnso\Tasks\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use LaravelEnso\Tasks\Models\Task;

class TaskNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via()
    {
        return ['mail', 'broadcast'];
    }

    public function toBroadcast()
    {
        return new BroadcastMessage([
            'level' => 'info',
            'title' => __('Task'),
            'icon' => 'bell',
            'body' => __('Task :description', ['description' => $this->task->description]),
            'path' => "/tasks/{$this->task->id}/edit",
        ]);
    }

    public function toMail()
    {
        return (new MailMessage())
            ->subject(__('Task'))
            ->line(__('Task :description', ['description' => $this->task->description]))
            ->action('View Task', route('tasks.edit', [$this->task->id]));
    }
}
