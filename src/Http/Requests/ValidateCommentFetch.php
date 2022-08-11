<?php

namespace LaravelEnso\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCommentFetch extends FormRequest
{
    public function rules()
    {
        return [
            'task_id' => "required",
            ];
    }
}
