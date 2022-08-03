<?php

namespace LaravelEnso\Tasks\Http\Resources;

use LaravelEnso\Tasks\Http\Resources\ChecklistItems;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use LaravelEnso\Users\Http\Resources\User;

class Task extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'reminder' => Carbon::parse($this->reminder)->format('d-m-Y H:i'),
            'from' => $this->from ? Carbon::parse($this->from)->format('d M Y') : null,
            'to' => Carbon::parse($this->to)->format('d M Y'),
            'muted' => $this->muted,
            'status' => $this->status,
            'flag' => $this->flag,
            'overdue' => $this->overdue(),
            'remindedAt' => $this->reminded_at,
            'allocatedTo' => new User($this->whenLoaded('allocatedTo')),
            'createdBy' => new User($this->whenLoaded('createdBy')),
            'taskChecklistItems' => ChecklistItems::collection($this->whenLoaded('checklistItems')),
            'completedTaskChecklistItems' => $this->completedTaskChecklistItems(),
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y H:i'),
            'updatedAt' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }

    public function completedTaskChecklistItems()
    {
        return "{$this->checklistItems()->completed()->count()}/{$this->checklistItems->count()}";
    }
}
