<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Tables\Traits\Excel;
use LaravelEnso\Tasks\Tables\Builders\Task;

class ExportExcel extends Controller
{
    use Excel;

    protected string $tableClass = Task::class;
}
