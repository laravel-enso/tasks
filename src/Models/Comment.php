<?php

namespace LaravelEnso\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Helpers\Traits\UpdatesOnTouch;
use LaravelEnso\TrackWho\Traits\CreatedBy;
use LaravelEnso\TrackWho\Traits\UpdatedBy;

class Comment extends Model
{
    use CreatedBy;
    use HasFactory;
    use UpdatedBy;
    use UpdatesOnTouch;

    protected $guarded = ['id'];
}
