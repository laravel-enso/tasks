<?php

namespace LaravelEnso\Tasks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaravelEnso\Tables\Traits\TableCache;

class ChecklistItem extends Model
{
    use TableCache;
    protected $table = 'task_checklist_items';

    protected $guarded = ['id'];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }
}
