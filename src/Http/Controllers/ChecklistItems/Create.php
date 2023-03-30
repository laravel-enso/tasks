<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Forms\Builders\ChecklistItem;

class Create extends Controller
{
    public function __invoke(ChecklistItem $form)
    {
        return ['form' => $form->create()];
    }
}
