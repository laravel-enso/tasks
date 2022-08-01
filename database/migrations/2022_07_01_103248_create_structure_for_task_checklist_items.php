<?php

use LaravelEnso\Migrator\Database\Migration;

return new class extends Migration
{
    protected array $permissions = [
        ['name' => 'tasks.checklistItems.store', 'description' => 'Store a new check list', 'is_default' => false],
        ['name' => 'tasks.checklistItems.update', 'description' => 'Update check list', 'is_default' => false],
        ['name' => 'tasks.checklistItems.destroy', 'description' => 'Delete check list', 'is_default' => false],
    ];

    protected ?string $parentMenu = '';
};

