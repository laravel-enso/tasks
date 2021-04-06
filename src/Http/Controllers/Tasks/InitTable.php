<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Init;
use LaravelEnso\Tasks\Tables\Builders\TaskTable;

class InitTable extends Controller
{
    use Init;

    protected string $tableClass = TaskTable::class;
}
