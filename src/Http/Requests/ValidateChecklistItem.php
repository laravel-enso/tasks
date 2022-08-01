<?php

namespace LaravelEnso\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateChecklistItem extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => "{$this->requiredOrFilled()}|string|max:255",
            'task_id' => "{$this->requiredOrFilled()}|integer|exists:tasks,id",
            'order_index' => 'nullable|integer',
            'is_completed' => 'nullable|boolean',
        ];
    }

    private function requiredOrFilled()
    {
        return $this->method() === 'POST'
            ? 'required'
            : 'filled';
    }
}
