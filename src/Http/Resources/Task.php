<?php

namespace LaravelEnso\Tasks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use LaravelEnso\Tasks\Http\Resources\ChecklistItem;

class Task extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'status'                => $this->status,
            'description'           => $this->description,
            'flag'                  => $this->flag,
            'overdue'               => $this->overdue(),
            'reminder'              => $this->reminder,
            'from'                  => Carbon::parse($this->from)->toFormattedDateString(),
            'to'                    => Carbon::parse($this->to)->toFormattedDateString(),
            'taskChecklistItems'    => ChecklistItem::collection($this->whenLoaded('checklistItems')),
            'completedChecklist'    => $this->completedChecklist(),
            'allocatedTo'           => $this->allocatedTo,
            'createdBy'             => $this->createdBy->person->name,
            'updatedAt'             => $this->updated_at->diffForHumans(),
            'muted'                 => $this->muted,
        ];
    }

    private function completedChecklist(): string
    {
        return "{$this->checklistItems()->completed()->count()}/{$this->checklistItems->count()}";
    }
}
