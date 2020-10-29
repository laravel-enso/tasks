<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Resources\Task;

class Index extends Controller
{
    public function __invoke(Request $request)
    {
        return Task::collection(
            $request->user()->allocatedTasks()
                ->skip($request->get('offset'))
                ->take($request->get('paginate'))
                ->pending()
                ->get()
        );
    }
}
