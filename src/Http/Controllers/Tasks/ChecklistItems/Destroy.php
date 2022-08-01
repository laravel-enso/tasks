<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks\ChecklistItems;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Models\ChecklistItem;

class Destroy extends Controller
{
    public function __invoke(ChecklistItem $checklistItem)
    {
        $checklistItem->delete();

        return [
            'message' => __('The item was successfully deleted'),
        ];
    }
}
