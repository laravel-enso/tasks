<?php

namespace LaravelEnso\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Tables\Traits\TableCache;

class ChecklistItem extends Model
{
    use TableCache;

    protected $table = 'task_checklist_items';

    protected $guarded = ['id'];

    protected $casts = ['is_completed' => 'boolean'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function scopeCompleted($query)
    {
        return $query->whereIsCompleted(true);
    }

    public function scopePending($query)
    {
        return $query->whereIsCompleted(false);
    }
}
