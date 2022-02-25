<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\ValidateTask;
use LaravelEnso\Tasks\Models\Task;

class Store extends Controller
{
    public function __invoke(ValidateTask $request, Task $task)
    {
        $task->fill($request->validated())->save();

        return [
            'message'  => __('The task was successfully created'),
            'redirect' => 'tasks.edit',
            'param'    => ['task' => $task->id],
        ];
    }
}
