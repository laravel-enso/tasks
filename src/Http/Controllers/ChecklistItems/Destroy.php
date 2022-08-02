<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use LaravelEnso\Tasks\Models\ChecklistItem;
use Illuminate\Routing\Controller;
use function __;

class Destroy extends Controller
{
    public function __invoke(ChecklistItem $checklistItem)
    {
        $checklistItem->delete();

        return [
            'message' => __('The checklist item was successfully deleted'),
            'redirect' => 'checklists.index',
        ];
    }
}
