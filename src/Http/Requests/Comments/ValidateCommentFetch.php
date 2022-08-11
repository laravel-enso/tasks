<?php

namespace LaravelEnso\Tasks\Http\Requests\Task\Comments;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCommentFetch extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'task_id' => 'required',
        ];
    }
}
