<?php

namespace LaravelEnso\Tasks\Http\Requests\Task\Comments;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCommentUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => 'required',
            'path' => 'required',
        ];
    }
}
