<?php

namespace LaravelEnso\Tasks\Http\Controllers\ChecklistItems;

use LaravelEnso\Tasks\Forms\Builders\ChecklistItem;
use Illuminate\Routing\Controller;

class Create extends Controller
{
    public function __invoke(ChecklistItem $form)
    {
        return ['form' => $form->create()];
    }
}
