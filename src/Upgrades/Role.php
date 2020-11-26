<?php

namespace LaravelEnso\Tasks\Upgrades;

use LaravelEnso\Permissions\Models\Permission;
use LaravelEnso\Upgrade\Contracts\MigratesStructure;
use LaravelEnso\Upgrade\Traits\StructureMigration;

class Role implements MigratesStructure
{
    use StructureMigration;


    protected $permissions = [
        ['name' => 'tasks.allocatedTo.options', 'description' => 'Get user options for select', 'is_default' => false],
    ];

    protected $roles;

    public function __construct()
    {
        $this->roles = Permission::with('roles')
            ->whereName('administration.users.options')
            ->first()
            ->roles
            ->map(fn($role) => $role->name)
            ->toArray();
    }
}
