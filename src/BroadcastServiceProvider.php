<?php

namespace LaravelEnso\Tasks;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Broadcast::channel(
            'tasks.{userId}',
            fn ($user, $userId) => (int) $user->id === (int) $userId
        );

        Broadcast::channel('task-updates', fn () => Auth::check());
    }
}
