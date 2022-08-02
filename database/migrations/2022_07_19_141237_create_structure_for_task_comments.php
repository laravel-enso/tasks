<?php

use LaravelEnso\Migrator\Database\Migration;

return new class extends Migration {
    protected array $permissions = [
        ['name' => 'tasks.comments.index', 'description' => 'List task comments for commentable', 'is_default' => true],
        ['name' => 'tasks.comments.store', 'description' => 'Create task comment', 'is_default' => true],
        ['name' => 'tasks.comments.update', 'description' => 'Update task edited comment', 'is_default' => true],
        ['name' => 'tasks.comments.destroy', 'description' => 'Delete task comment', 'is_default' => true],
    ];
};
