<?php

namespace LaravelEnso\Tasks;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Mails\Preview\PreviewDefinition;
use LaravelEnso\Mails\Preview\PreviewRegistry;

class MailServiceProvider extends ServiceProvider
{
    public function boot(PreviewRegistry $registry): void
    {
        $registry->register(new PreviewDefinition(
            key: 'task-reminder',
            name: 'Task Reminder',
            view: 'laravel-enso/tasks::emails.task-reminder',
            data: [
                'name' => 'Follow up on customer request',
                'description' => 'Review the pending customer request and update the internal note.',
                'url' => 'https://example.com/tasks/42/edit',
            ],
            section: PreviewDefinition::Core,
        ));
    }
}
