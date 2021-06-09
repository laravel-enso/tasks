<?php

namespace LaravelEnso\Tasks;

use LaravelEnso\Core\Facades\Websockets;
use LaravelEnso\Core\WebsocketServiceProvider as CoreServiceProvider;
use LaravelEnso\Users\Models\User;

class WebsocketServiceProvider extends CoreServiceProvider
{
    public function boot()
    {
        Websockets::register([
            'task' => fn (User $user) => 'tasks.'.$user->id,
        ]);
    }
}
