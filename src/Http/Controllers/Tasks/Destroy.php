<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use LaravelEnso\Tasks\Models\Task;
use Illuminate\Routing\Controller;

class Destroy extends Controller
{
    public function __invoke(Task $task)
    {
        $task->delete();

        return [
            'message' => __('The task was successfully deleted'),
            'redirect' => 'tasks.index',
        ];
    }
}
