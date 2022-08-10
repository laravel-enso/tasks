<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks\ChecklistItems;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\ValidateChecklistItem;
use LaravelEnso\Tasks\Models\ChecklistItem;

class Store extends Controller
{
    public function __invoke(ValidateChecklistItem $request, ChecklistItem $checklistItem)
    {
        $checklistItem->fill($request->validated() + ['is_completed' => false])->save();

        return [
            'message' => __('The item was successfully created'),
            'param'   => ['checklist' => $checklistItem->id],
            'data'    => $checklistItem,
        ];
    }
}
