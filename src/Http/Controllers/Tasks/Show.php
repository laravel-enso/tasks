<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Resources\Task as Resource;
use LaravelEnso\Tasks\Models\Task;

class Show extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Task $task)
    {
        $this->authorize('handle', $task);

        return ['task' => new Resource($task->load(['checklistItems', 'allocatedTo',
            'allocatedTo.avatar', 'allocatedTo.person', 'createdBy', 'createdBy.person', ]))];
    }
}
