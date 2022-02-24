<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Init;
use LaravelEnso\Tasks\Tables\Builders\Task;

class InitTable extends Controller
{
    use Init;

    protected string $tableClass = Task::class;
}
