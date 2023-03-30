<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use function __;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Models\ChecklistItem;

class Destroy extends Controller
{
    public function __invoke(ChecklistItem $checklistItem)
    {
        $checklistItem->delete();

        return [
            'message'  => __('The checklist item was successfully deleted'),
            'redirect' => 'checklists.index',
        ];
    }
}
