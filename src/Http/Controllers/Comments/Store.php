<?php

namespace LaravelEnso\Tasks\Http\Controllers\Comments;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\ValidateComment;
use LaravelEnso\Tasks\Http\Resources\Comment as Resource;
use LaravelEnso\Tasks\Models\Comment;

class Store extends Controller
{
    public function __invoke(ValidateComment $request, Comment $comment)
    {
        $comment->fill($request->validatedExcept('path'));

        tap($comment)->save();

        return new Resource($comment->load([
            'createdBy.person', 'createdBy.avatar',
        ]));
    }
}
