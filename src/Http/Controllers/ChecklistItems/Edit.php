<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use LaravelEnso\Tasks\Forms\Builders\ChecklistItem as Form;
use LaravelEnso\Tasks\Models\ChecklistItem;
use Illuminate\Routing\Controller;

class Edit extends Controller
{
    public function __invoke(ChecklistItem $checklistItem, Form $form)
    {
        return ['form' => $form->edit($checklistItem)];
    }
}
