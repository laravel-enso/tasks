<?php

namespace LaravelEnso\Tasks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChecklistItem extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'task_id'       => $this->task_id,
            'is_completed'  => $this->is_completed,
            'orderIndex'    => $this->order_index,
            'createdAt'     => $this->created_at->toDatetimeString(),
        ];
    }
}
