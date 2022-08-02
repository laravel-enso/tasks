<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use LaravelEnso\Tasks\Models\ChecklistItem;
use Illuminate\Routing\Controller;
use LaravelEnso\Select\Traits\OptionsBuilder;

class Options extends Controller
{
    use OptionsBuilder;

    protected string $model = ChecklistItem::class;

}
