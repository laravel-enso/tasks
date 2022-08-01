<?php

namespace LaravelEnso\Tasks\Observers;

use LaravelEnso\Tasks\Models\ChecklistItem as CheckListModel;

class ChecklistItem
{
    public function created(CheckListModel $checklist)
    {
        $checklist->task->updateStatus();
    }

    public function updated(CheckListModel $checklist)
    {
        if ($checklist->isDirty('is_completed')) {
            $checklist->task->updateStatus();
        }
    }

    public function deleted(CheckListModel $checklist)
    {
        $checklist->task->updateStatus();
    }
}
