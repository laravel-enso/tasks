<?php

namespace LaravelEnso\Tasks\Upgrades;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Tasks\Enums\Statuses as StatusesEnum;
use LaravelEnso\Tasks\Models\Task;
use LaravelEnso\Upgrade\Contracts\MigratesData;
use LaravelEnso\Upgrade\Contracts\MigratesPostDataMigration;
use LaravelEnso\Upgrade\Contracts\MigratesTable;
use LaravelEnso\Upgrade\Helpers\Table;

class Statuses implements MigratesTable, MigratesPostDataMigration, MigratesData
{
    public function isMigrated(): bool
    {
        return Table::hasColumn('tasks', 'status');
    }

    public function migrateTable(): void
    {
        Schema::table('tasks', function ($table) {
            $table->tinyInteger('status')->nullable()->after('reminder');
        });
    }

    public function migrateData(): void
    {
        Task::whereCompleted(false)
            ->update(['status' => StatusesEnum::New]);
        Task::whereCompleted(true)
            ->update(['status' => StatusesEnum::Finished]);
    }

    public function migratePostDataMigration(): void
    {
        Schema::table('tasks', function ($table) {
            $table->dropColumn('completed');
        });

        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE `tasks` CHANGE status status TINYINT(3) NOT NULL');
        }
    }
}
