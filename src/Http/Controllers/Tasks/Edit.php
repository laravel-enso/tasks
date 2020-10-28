<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use LaravelEnso\Tasks\Models\Task;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Forms\Builders\TaskForm;

class Edit extends Controller
{
    public function __invoke(Task $task, TaskForm $form)
    {
        return ['form' => $form->edit($task)];
    }
}
