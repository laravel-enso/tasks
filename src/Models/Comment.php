<?php

namespace LaravelEnso\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use LaravelEnso\Comments\Notifications\CommentTagNotification;
use LaravelEnso\Helpers\Traits\UpdatesOnTouch;
use LaravelEnso\TrackWho\Traits\CreatedBy;
use LaravelEnso\TrackWho\Traits\UpdatedBy;
use LaravelEnso\Users\Models\User;

class Comment extends Model
{
    use CreatedBy, HasFactory, UpdatedBy, UpdatesOnTouch;

    protected $guarded = ['id'];

    protected $table = 'task_comments';

}
