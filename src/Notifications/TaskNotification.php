<?php

namespace LaravelEnso\Tasks\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
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
        return ['mail', 'broadcast', 'database'];
    }

    public function toBroadcast()
    {
        return new BroadcastMessage($this->toArray() + [
            'level' => 'warning',
            'title' => __('Task Reminder'),
        ]);
    }

    public function toMail()
    {
        return (new MailMessage())
            ->subject(__(Config::get('app.name')).': '.__('Task Reminder'))
            ->line(__('This is a reminder for the following task:'))
            ->line(__(':name: :description', [
                'name' => $this->task->name,
                'description' => $this->task->description,
            ]))->action(__('View Task'), "/tasks/{$this->task->id}/edit");
    }

    public function toArray()
    {
        return [
            'body' => __('Task :description', ['description' => $this->task->description]),
            'icon' => 'bell',
            'path' => "/tasks/{$this->task->id}/edit",
        ];
    }
}
