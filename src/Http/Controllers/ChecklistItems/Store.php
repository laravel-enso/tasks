<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use LaravelEnso\Tasks\Http\Requests\ValidateChecklistItem;
use LaravelEnso\Tasks\Models\ChecklistItem;
use Illuminate\Routing\Controller;
use function __;

class Store extends Controller
{
    public function __invoke(ValidateChecklistItem $request, ChecklistItem $checklistItem)
    {
        $checklistItem->fill($request->validated())->save();

        return [
            'message' => __('The checklist item was successfully created'),
            'redirect' => 'taskChecklistItems.edit',
            'param' => ['checklist' => $checklistItem->id],
        ];
    }
}
