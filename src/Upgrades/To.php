<?php

namespace LaravelEnso\Tasks\Upgrades;

use Illuminate\Support\Facades\Schema;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

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
