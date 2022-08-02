<?php

namespace LaravelEnso\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateChecklistItem extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', $this->unique('name'), 'max:255'],
            'task_id' => ['required', 'exists:tasks,id'],
            'is_completed' => 'required|boolean'
        ];
    }

    protected function unique(string $attribute)
    {
        return Rule::unique('task_checklist_items', $attribute)
            ->ignore($this->route('checklistItem')?->id);
    }
}
