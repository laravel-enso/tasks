<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Select\Traits\OptionsBuilder;
use LaravelEnso\Tasks\Models\Task;

class Options extends Controller
{
    use OptionsBuilder;

    protected string $model = Task::class;
}
