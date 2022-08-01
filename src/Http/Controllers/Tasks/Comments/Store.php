<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks\Comments;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\Task\Comments\ValidateCommentStore;
use LaravelEnso\Tasks\Http\Resources\Comment as Resource;
use LaravelEnso\Tasks\Models\TaskComment;

class Store extends Controller
{
    public function __invoke(ValidateCommentStore $request, TaskComment $comment)
    {
        $comment->fill($request->validatedExcept('path'));
        tap($comment)->save();

        return new Resource($comment->load([
            'createdBy.person', 'createdBy.avatar',
        ]));
    }
}
