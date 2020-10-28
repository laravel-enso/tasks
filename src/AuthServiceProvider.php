<?php

namespace LaravelEnso\Tasks;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Tasks\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => TaskPolicy::class
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
