<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Forms\Builders\TaskForm;
use LaravelEnso\Tasks\Models\Task;

class Edit extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Task $task, TaskForm $form)
    {
        $this->authorize('handle', $task);

        return ['form' => $form->edit($task)];
    }
}
