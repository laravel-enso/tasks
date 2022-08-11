<?php

use LaravelEnso\Migrator\Database\Migration;

return new class extends Migration {
    protected array $permissions = [
        ['name' => 'tasks.index', 'description' => 'Show index for tasks', 'is_default' => false],
        ['name' => 'tasks.create', 'description' => 'Create task', 'is_default' => false],
        ['name' => 'tasks.store', 'description' => 'Store a new task', 'is_default' => false],
        ['name' => 'tasks.edit', 'description' => 'Edit task', 'is_default' => false],
        ['name' => 'tasks.update', 'description' => 'Update task', 'is_default' => false],
        ['name' => 'tasks.destroy', 'description' => 'Delete task', 'is_default' => false],
        ['name' => 'tasks.initTable', 'description' => 'Init table for tasks', 'is_default' => false],
        ['name' => 'tasks.tableData', 'description' => 'Get table data for tasks', 'is_default' => false],
        ['name' => 'tasks.exportExcel', 'description' => 'Export excel for tasks', 'is_default' => false],
        ['name' => 'tasks.count', 'description' => 'Get number of pending tasks', 'is_default' => false],
        ['name' => 'tasks.users', 'description' => 'Get user options for task allocation', 'is_default' => false],
    ];

    protected array $menu = [
        'name' => 'Tasks', 'icon' => 'tasks', 'route' => 'tasks.index', 'order_index' => 207, 'has_children' => false,
    ];

    protected ?string $parentMenu = '';
};
