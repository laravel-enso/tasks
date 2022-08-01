<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks\Comments;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Models\TaskComment;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(TaskComment $comment)
    {
        $this->authorize('destroy', $comment);

        $comment->delete();

        return ['count' => $comment->count()];
    }
}
