<?php

namespace LaravelEnso\Tasks\Forms\Builders;

use Illuminate\Support\Facades\Auth;
use LaravelEnso\Forms\Services\Form;
use LaravelEnso\Tasks\Models\Task;

class TaskForm
{
    protected const TemplatePath = __DIR__.'/../Templates/task.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = (new Form(static::TemplatePath))
            ->value('allocated_to', Auth::id())
            ->when($this->cantAllocate(), fn ($form) => $form
                ->readonly('allocated_to'));
    }

    public function create()
    {
        return $this->form->hide('completed')->create();
    }

    public function edit(Task $task)
    {
        return $this->form->edit($task);
    }

    private function cantAllocate(): bool
    {
        return ! Auth::user()->isAdmin()
            && ! Auth::user()->isSupervisor();
    }
}
