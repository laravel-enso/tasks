<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use function __;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\ValidateChecklistItem;
use LaravelEnso\Tasks\Models\ChecklistItem;

class Store extends Controller
{
    public function __invoke(ValidateChecklistItem $request, ChecklistItem $checklistItem)
    {
        $checklistItem->fill($request->validated())->save();

        return [
            'message'  => __('The checklist item was successfully created'),
            'redirect' => 'tasks.checklistItems.edit',
            'param'    => ['checklist' => $checklistItem->id],
        ];
    }
}
