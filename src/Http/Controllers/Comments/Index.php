<?php

namespace LaravelEnso\Tasks\Http\Controllers\Comments;

use LaravelEnso\Tasks\Http\Requests\ValidateCommentFetch;
use LaravelEnso\Tasks\Http\Resources\Comment as Resource;
use LaravelEnso\Tasks\Models\Comment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

class Index extends Controller
{
    public function __invoke(ValidateCommentFetch $request)
    {
        $comments = Comment::where('task_id', $request->task_id)->latest()
            ->with('createdBy.person', 'createdBy.avatar', 'updatedBy')
            ->get();

        return Resource::collection($comments)->additional([
            'humanReadableDates' => Config::get('enso.comments.humanReadableDates'),
        ]);
    }
}
