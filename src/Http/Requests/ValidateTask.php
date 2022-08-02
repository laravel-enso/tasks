<?php

namespace LaravelEnso\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use LaravelEnso\Tasks\Enums\Flags;
use LaravelEnso\Tasks\Models\Task;

class ValidateTask extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'         => "{$this->requiredOrFilled()}|string",
            'description'  => 'filled',
            'flag'         => 'nullable|in:'.Flags::keys()->implode(','),
            'reminder'     => 'nullable|date',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'muted' => 'nullable|boolean',
            'allocated_to' => "{$this->requiredOrFilled()}|exists:users,id",
            'status' => "{$this->requiredOrFilled()}",
        ];
    }

    public function withValidator($validator)
    {
        if ($this->filled('reminder')) {
            $validator->after(fn ($validator) => $this
                ->validateReminder($validator));
        }
    }

    private function requiredOrFilled()
    {
        return $this->method() === 'POST'
            ? 'required'
            : 'filled';
    }

    private function validateReminder($validator)
    {
        if ($this->invalidReminder()) {
            $validator->errors()
                ->add('reminder', 'The reminder must be a date after now.');
        }
    }

    private function task(): ?Task
    {
        return $this->route()->parameter('task');
    }

    private function invalidReminder(): bool
    {
        $changed = !$this->task()?->reminder
            || $this->task()->reminder->notEqualTo($this->get('reminder'));

        return $changed
            && Carbon::now()->greaterThan($this->get('reminder'));
    }
}
