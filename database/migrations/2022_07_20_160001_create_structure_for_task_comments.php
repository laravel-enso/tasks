<?php

use LaravelEnso\Migrator\Database\Migration;

return new class extends Migration
{
    protected array $permissions = [
        ['name' => 'tasks.comments.index', 'description' => 'Show index for comments', 'is_default' => false],
        ['name' => 'tasks.comments.store', 'description' => 'Store a new comment', 'is_default' => false],
        ['name' => 'tasks.comments.update', 'description' => 'Update comment', 'is_default' => false],
        ['name' => 'tasks.comments.destroy', 'description' => 'Delete comment', 'is_default' => false],
    ];
};
