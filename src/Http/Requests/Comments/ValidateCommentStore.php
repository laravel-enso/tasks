<?php

namespace LaravelEnso\Tasks\Http\Requests\Task\Comments;

use LaravelEnso\Helpers\Traits\FiltersRequest;

class ValidateCommentStore extends ValidateCommentFetch
{
    use FiltersRequest;

    public function rules()
    {
        return parent::rules() + [
            'body' => 'required',
            'path' => 'required',
        ];
    }
}
