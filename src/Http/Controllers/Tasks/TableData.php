<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Data;
use LaravelEnso\Tasks\Tables\Builders\TaskTable;

class TableData extends Controller
{
    use Data;

    protected string $tableClass = TaskTable::class;
}
