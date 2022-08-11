<?php

use LaravelEnso\Migrator\Database\Migration;

class CreateStructureForChecklistItems extends Migration
{
    protected array $permissions = [
        ['name' => 'tasks.checklistItems.index', 'description' => 'Show index for task checklist items', 'is_default' => false],

        ['name' => 'tasks.checklistItems.store', 'description' => 'Store a new task checklist item', 'is_default' => false],
        ['name' => 'tasks.checklistItems.update', 'description' => 'Update task checklist item', 'is_default' => false],
        ['name' => 'tasks.checklistItems.destroy', 'description' => 'Delete task checklist item', 'is_default' => false],


        ['name' => 'tasks.checklistItems.options', 'description' => 'Get task checklist item options for select', 'is_default' => false],
    ];

    protected array $menu = [];

    protected ?string $parentMenu = null;
}

