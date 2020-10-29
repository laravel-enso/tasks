<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Responses\TaskCount;

class Count extends Controller
{
    public function __invoke(Request $request)
    {
        return new TaskCount($request->user());
    }
}
