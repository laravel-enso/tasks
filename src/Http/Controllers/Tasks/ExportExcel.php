<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use LaravelEnso\Tasks\Tables\Builders\TaskTable;
use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Excel;

class ExportExcel extends Controller
{
    use Excel;

    protected string $tableClass = TaskTable::class;
}
