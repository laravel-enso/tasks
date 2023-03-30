<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/tasks')
    ->as('tasks.')
    ->group(function () {
        require __DIR__.'/app/comments.php';
        require __DIR__.'/app/tasks.php';
        require __DIR__.'/app/checklistItems.php';
    });
