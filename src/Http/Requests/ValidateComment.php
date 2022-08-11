<?php

namespace LaravelEnso\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LaravelEnso\Helpers\Traits\FiltersRequest;

class ValidateComment extends FormRequest
{
    use FiltersRequest;

    public function rules()
    {
        return [
            'task_id' => "{$this->requiredOrFilled()}|exists:tasks,id",
            'body' => "{$this->requiredOrFilled()}|required",
            'path' => "{$this->requiredOrFilled()}",
            ];
    }

    private function requiredOrFilled()
    {
        return $this->method() === 'POST'
            ? 'required'
            : 'filled';
    }
}
