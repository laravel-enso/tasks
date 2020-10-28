<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Tasks\Models\Task;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\ValidateTaskRequest;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateTaskRequest $request, Task $task)
    {
        $this->authorize('handle', $task);

        throw_if($task->allocated_to !== $request->get('allocated_to')
            && ! Auth::user()->isAdmin()
            && ! Auth::user()->isSupervisor(), AuthorizationException::class);

        $task->update($request->validated());

        return ['message' => __('The task was successfully updated')];
    }
}
