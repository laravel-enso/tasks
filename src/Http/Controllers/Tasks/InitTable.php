<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use LaravelEnso\Tasks\Tables\Builders\TaskTable;
use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Init;

class InitTable extends Controller
{
    use Init;

    protected string $tableClass = TaskTable::class;
}
