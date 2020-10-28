<?php

namespace LaravelEnso\Tasks\Forms\Builders;

use Illuminate\Support\Facades\Auth;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Forms\Services\Form;

class TaskForm
{
    protected const TemplatePath = __DIR__.'/../Templates/task.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = new Form(static::TemplatePath);
    }

    public function create()
    {
        return $this->form->hide('completed')->create();
    }

    public function edit(Task $task)
    {
        $form = $this->form;

        if (! Auth::user()->isAdmin() && ! Auth::user()->isSupervisor()) {
            $form->readonly('allocated_to');
        }

        return $form->edit($task);
    }
}
