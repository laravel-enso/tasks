<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use Illuminate\Routing\Controller;
use LaravelEnso\Select\Traits\OptionsBuilder;
use LaravelEnso\Tasks\Models\ChecklistItem;

class Options extends Controller
{
    use OptionsBuilder;

    protected string $model = ChecklistItem::class;
}
