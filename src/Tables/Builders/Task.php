<?php

namespace LaravelEnso\Tasks\Tables\Builders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Helpers\Services\Obj;
use LaravelEnso\Tables\Contracts\AuthenticatesOnExport;
use LaravelEnso\Tables\Contracts\ConditionalActions;
use LaravelEnso\Tables\Contracts\CustomFilter;
use LaravelEnso\Tables\Contracts\Table;
use LaravelEnso\Tasks\Models\Task as Model;

class Task implements Table, AuthenticatesOnExport, CustomFilter, ConditionalActions
{
    private const TemplatePath = __DIR__.'/../Templates/tasks.json';

    public function query(): Builder
    {
        $now = Carbon::now();
        $overdue = "completed = true and reminder >= '{$now}'";

        return Model::visible()
            ->with('createdBy.avatar', 'createdBy.person')
            ->with('allocatedTo.avatar', 'allocatedTo.person')
            ->selectRaw("
                tasks.id, tasks.name, tasks.description, tasks.flag, tasks.completed,
                tasks.allocated_to, tasks.reminder, tasks.reminder as rawReminder,
                created_by, created_at, {$overdue} as overdue
            ");
    }

    public function templatePath(): string
    {
        return static::TemplatePath;
    }

    public function filterApplies(Obj $params): bool
    {
        return $params->get('overdue') === true;
    }

    public function filter(Builder $query, Obj $params)
    {
        $query->overdue();
    }

    public function render(array $row, string $action): bool
    {
        $isSuperior = Auth::user()->isAdmin() || Auth::user()->isSupervisor();

        return $isSuperior
            || $row['createdBy']['id'] === Auth::user()->id;
    }
}
