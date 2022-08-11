<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use function __;
use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Http\Requests\ValidateChecklistItem;
use LaravelEnso\Tasks\Models\ChecklistItem;

class Update extends Controller
{
    public function __invoke(ValidateChecklistItem $request, ChecklistItem $checklistItem)
    {
        $checklistItem->update($request->validated());

        return ['message' => __('The checklist item was successfully updated')];
    }
}
