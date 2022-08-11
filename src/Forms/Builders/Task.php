<?php

namespace LaravelEnso\Tasks\Forms\Builders;

use Illuminate\Support\Facades\Auth;
use LaravelEnso\Forms\Services\Form;
use LaravelEnso\Tasks\Enums\Statuses;
use LaravelEnso\Tasks\Models\Task as Model;

class Task
{
    private const TemplatePath = __DIR__.'/../Templates/task.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = (new Form($this->templatePath()))
            ->when($this->cantAllocate(), fn ($form) => $form
                ->readonly('allocated_to'));
    }

    public function create()
    {
        return $this->form->hide('status')
            ->value('allocated_to', Auth::id())
            ->value('status', Statuses::New)
            ->create();
    }

    public function edit(Model $task)
    {
        return $this->form->edit($task);
    }

    private function cantAllocate(): bool
    {
        return !Auth::user()->isAdmin()
            && !Auth::user()->isSupervisor();
    }

    protected function templatePath(): string
    {
        return self::TemplatePath;
    }
}
