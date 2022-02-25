<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelEnso\Tasks\Forms\Builders\Task;

class Create extends Controller
{
    public function __invoke(Task $form)
    {
        return ['form' => $form->create()];
    }
}
