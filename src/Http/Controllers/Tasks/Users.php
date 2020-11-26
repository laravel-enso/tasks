<?php

namespace LaravelEnso\Tasks\Http\Controllers\Tasks;

use Illuminate\Support\Facades\Config;
use LaravelEnso\Core\Http\Controllers\Administration\User\Options as UserOptions;

class Users extends UserOptions
{
    public function query()
    {
        $roles = Config::get('enso.tasks.allocated_to.roles');

        return parent::query()
            ->when($roles !== ['*'], fn ($query) => $query->whereIn('role_id', $roles));
    }
}
