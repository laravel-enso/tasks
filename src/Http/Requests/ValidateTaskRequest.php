<?php

namespace LaravelEnso\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use LaravelEnso\Tasks\Enums\Flags;
use LaravelEnso\Tasks\Models\Task;

class ValidateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'filled',
            'flag' => 'nullable|in:'.Flags::keys()->implode(','),
            'reminder' => 'nullable|date',
            'allocated_to' => 'required|exists:users,id',
            'completed' => 'required|boolean',
        ];
    }

    public function withValidator($validator)
    {
        if ($this->filled('reminder')) {
            $validator->after(fn ($validator) => $this->validateReminder($validator));
        }
    }

    private function validateReminder($validator)
    {
        if ($this->invalidReminder()) {
            $validator->errors()->add('reminder', 'The reminder must be a date after now.');
        }
    }

    private function task(): ?Task
    {
        return $this->route()->parameter('task');
    }

    private function invalidReminder(): bool
    {
        $changed = ! optional($this->task())->reminder
            || $this->task()->reminder->notEqualTo($this->get('reminder'));

        return $changed
            && Carbon::now()->greaterThan($this->get('reminder'));
    }
}
