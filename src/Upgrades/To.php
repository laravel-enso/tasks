<?php

namespace LaravelEnso\Tasks\Upgrades;

use Illuminate\Support\Facades\Schema;
use LaravelEnso\Tasks\Enums\Statuses as StatusesEnum;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;
use LaravelEnso\Tasks\Models\Task;

class To implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('tasks', 'to');
    }

    public function migrateTable(): void
    {
        Schema::table('tasks', function ($table) {
            $table->dateTime('to')->nullable()->after('reminder');
        });
    }
    
}
