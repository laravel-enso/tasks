<?php

namespace LaravelEnso\Tasks;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelEnso\Tasks\Models\Comment;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Tasks\Policies\Comment as TaskCommentPolicy;
use LaravelEnso\Tasks\Policies\Task as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class     => Policy::class,
        Comment::class  => TaskCommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
