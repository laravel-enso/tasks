<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks\AllocatedTo;

use Illuminate\Support\Facades\Config;
use LaravelEnso\Core\Http\Controllers\Administration\User\Options as UserOptions;

class Options extends UserOptions
{
    public function query()
    {
        return parent::query()
            ->when(Config::get('enso.tasks.allocated_to.roles') !== null, fn ($query) => $query
                ->whereIn('role_id', Config::get('enso.tasks.allocated_to.roles')));
    }
}
