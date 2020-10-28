<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use LaravelEnso\Tasks\Tables\Builders\TaskTable;
use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Data;

class TableData extends Controller
{
    use Data;

    protected string $tableClass = TaskTable::class;
}
