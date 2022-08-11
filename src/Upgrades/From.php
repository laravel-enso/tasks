<?php

namespace LaravelEnso\Tasks\Upgrades;

use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class From implements MigratesTable
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('tasks', 'from');
    }

    public function migrateTable(): void
    {
        Schema::table('tasks', function ($table) {
            $table->dateTime('from')->nullable()->after('reminder');
        });
    }
}
