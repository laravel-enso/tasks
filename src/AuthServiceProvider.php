<?php

namespace LaravelEnso\Tasks;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Tasks\Models\TaskComment;
use LaravelEnso\Tasks\Policies\Task as Policy;
use LaravelEnso\Tasks\Policies\TaskComment as TaskCommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => Policy::class,
        TaskComment::class => TaskCommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
