<?php

namespace LaravelEnso\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Core\Models\User;
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
            'completed' => 'required|boolean',
            'flag' => 'nullable|in:'.Flags::keys()->implode(','),
            'allocated_to' => 'required|exists:users,id',
            'reminder' => 'nullable|date',
            'description' => 'required',
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
        $reminderChangedOrNew = ! $this->task()
            || ! $this->task()->reminder
            || $this->task()->reminder->notEqualTo($this->get('reminder'));

        return $reminderChangedOrNew
            && Carbon::now()->greaterThan($this->get('reminder'));
    }
}
