<?php

namespace LaravelEnso\Tasks\Tables\Builders;

use Illuminate\Support\Facades\Auth;
use LaravelEnso\Helpers\Services\Obj;
use LaravelEnso\Tables\Contracts\CustomFilter;
use LaravelEnso\Tasks\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use LaravelEnso\Tables\Contracts\Table;

class TaskTable implements Table, CustomFilter
{
    protected const TemplatePath = __DIR__.'/../Templates/tasks.json';

    public function query(): Builder
    {
        return Task::with(
            'createdBy.avatar', 'createdBy.person',
            'allocatedTo.avatar', 'allocatedTo.person',
        )->selectRaw('
            tasks.id, tasks.name, tasks.description, tasks.flag, tasks.completed, tasks.allocated_to,
            tasks.reminder, IF(completed, 0, reminder < CURRENT_DATE()) as overdue,
            created_by, created_at
        ')->when(! Auth::user()->isAdmin() && ! Auth::user()->isSupervisor(), fn ($query) => $query
            ->whereCreatedBy(Auth::user()->id));
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
}
