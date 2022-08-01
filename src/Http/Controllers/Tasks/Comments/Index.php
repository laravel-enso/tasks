<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks\Comments;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Tasks\Http\Resources\Comment as Resource;
use LaravelEnso\Tasks\Models\TaskComment;

class Index extends Controller
{
    public function __invoke(ValidateCommentFetch $request)
    {
        $comments = TaskComment::latest()->whereTaskId($request->validated())
            ->with('createdBy.person', 'createdBy.avatar', 'updatedBy')
            ->get();

        return Resource::collection($comments)->additional([
            'humanReadableDates' => Config::get('enso.comments.humanReadableDates'),
        ]);
    }
}
