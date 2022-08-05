<?php

namespace LaravelEnso\Tasks\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChecklistItems extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'taskId' => $this->task_id,
            'isCompleted' => $this->is_completed,
            'orderIndex' => $this->order_index,
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y H:i')
        ];
    }
}
