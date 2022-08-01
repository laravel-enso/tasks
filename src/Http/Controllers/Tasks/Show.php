<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use LaravelEnso\Tasks\Http\Resources\Task as TaskResource;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Models\Task;

class Show extends Controller
{
    public function __invoke(Task $task)
    {
        $task->load('checklistItems',
            'allocatedTo.person', 'allocatedTo.avatar', 'createdBy.avatar', 'createdBy.person'
        );
        return ['task' => new TaskResource($task)];
    }
}
