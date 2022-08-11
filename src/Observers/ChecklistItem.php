<?php

namespace LaravelEnso\Tasks\Observers;

use LaravelEnso\Tasks\Models\ChecklistItem as Model;

class ChecklistItem
{
    public function created(Model $checklist)
    {
        $checklist->task->updateStatus();
    }

    public function updated(Model $checklist)
    {
        if ($checklist->isDirty('is_completed')) {
            $checklist->task->updateStatus();
        }
    }

    public function deleted(Model $checklist)
    {
        $checklist->task->updateStatus();
    }
}
