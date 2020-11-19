<?php

namespace LaravelEnso\Tasks;

use LaravelEnso\Core\Facades\Websockets;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Core\WebsocketServiceProvider as CoreServiceProvider;

class WebsocketServiceProvider extends CoreServiceProvider
{
    public function boot()
    {
        Websockets::register([
            'task' => fn (User $user) => 'tasks.'.$user->id
        ]);
    }
}
