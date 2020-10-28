<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Forms\Builders\TaskForm;

class Create extends Controller
{
    public function __invoke(TaskForm $form)
    {
        return ['form' => $form->create()];
    }
}
