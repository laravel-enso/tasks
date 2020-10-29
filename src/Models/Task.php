<?php

namespace LaravelEnso\Tasks\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Tables\Traits\TableCache;
use LaravelEnso\Tasks\Notifications\TaskNotification;
use LaravelEnso\TrackWho\Traits\CreatedBy;
use LaravelEnso\TrackWho\Traits\UpdatedBy;

class Task extends Model
{
    use TableCache, CreatedBy, UpdatedBy;

    protected $guarded = ['id'];

    protected $dates = ['reminder', 'reminded_at'];

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function allocatedTo(): Relation
    {
        return $this->belongsTo(User::class, 'allocated_to');
    }

    public function scopeNotReminded($query)
    {
        return $query->whereNull('reminded_at');
    }

    public function scopeOverdue($query)
    {
        return $query->whereCompleted(false)
            ->where('reminder', '<=', Carbon::now());
    }

    public function scopePending($query)
    {
        return $query->whereCompleted(false);
    }

    public function setReminderAttribute($dateTime)
    {
        if (Carbon::now()->lessThan($dateTime)) {
            $this->reminded_at = null;
        }

        $this->attributes['reminder'] = $dateTime;
    }

    public function remind()
    {
        $this->allocatedTo->notify(new TaskNotification($this));

        $this->update(['reminded_at' => Carbon::now()]);
    }

    public function overdue(): bool
    {
        return ! $this->completed
            && optional($this->reminder)->lessThan(Carbon::now());
    }
}
