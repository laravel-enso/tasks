<?php

namespace LaravelEnso\Tasks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class Task extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'status'        => $this->status,
            'description'   => $this->description,
            'flag'          => $this->flag,
            'overdue'       => $this->overdue(),
            'reminder'      => $this->reminder,
            'from'          => Carbon::parse($this->from)->toFormattedDateString(),
            'to'            => Carbon::parse($this->to)->toFormattedDateString(),
            'checklist'     => $this->checklistItems,
            'completedChecklist' => $this->completedChecklist($this->checklistItems),
            'allocatedTo'   => $this->allocatedTo,
            'createdBy'     => $this->createdBy->person->name,
            'updatedAt'     => $this->updated_at->diffForHumans(),
            'muted'         => $this->muted,
        ];
    }

    private function completedChecklist($checklists): array
    {
        $completed = $checklists->filter(function ($checklist) {
            return $checklist->is_completed;
        })->count();

        return [
            'percentageValue' => $checklists->count() > 0 ? round(($completed / $checklists->count()) * 100) : 0,
            'percentageString' => $completed.'/'.count($checklists),
        ];
    }
}
