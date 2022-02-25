<?php

namespace LaravelEnso\Tasks\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'flag'        => $this->flag,
            'overdue'     => $this->overdue(),
            'reminder'    => $this->reminder,
        ];
    }
}
