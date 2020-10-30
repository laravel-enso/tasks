<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LaravelEnso\Tasks\Models\Task;
use Illuminate\Routing\Controller;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Task $task)
    {
        $this->authorize('handle', $task);

        $task->delete();

        return [
            'message' => __('The task was successfully deleted'),
            'redirect' => 'tasks.index',
        ];
    }
}
