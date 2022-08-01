<?php

namespace App\Upgrades;

use LaravelEnso\Upgrade\Contracts\MigratesStructure;
use LaravelEnso\Upgrade\Traits\StructureMigration;

class Permissions implements MigratesStructure
{
    use StructureMigration;

    protected array $permissions = [
        ['name' => 'tasks.show', 'description' => 'Display task information', 'is_default' => true],
        ['name' => 'tasks.options', 'description' => 'Get tasks options for select', 'is_default' => false]
    ];
}
