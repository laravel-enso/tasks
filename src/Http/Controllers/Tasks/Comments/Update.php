<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks\Comments;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\Task\Comments\ValidateCommentUpdate;
use LaravelEnso\Tasks\Http\Resources\Comment as Resource;
use LaravelEnso\Tasks\Models\Comment;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateCommentUpdate $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        tap($comment)->update($request->only('body'));

        return new Resource($comment->load([
            'createdBy.person', 'createdBy.avatar', 'updatedBy',
        ]));
    }
}
