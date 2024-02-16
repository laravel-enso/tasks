<?php

namespace LaravelEnso\Tasks\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Tables\Traits\TableCache;
use LaravelEnso\Tasks\Notifications\TaskNotification;
use LaravelEnso\TrackWho\Traits\CreatedBy;
use LaravelEnso\TrackWho\Traits\UpdatedBy;
use LaravelEnso\Users\Models\User;

class Task extends Model
{
    use TableCache;
    use HasFactory;
    use CreatedBy;
    use UpdatedBy;

    protected $guarded = ['id'];

    protected $casts = [
        'completed' => 'boolean',
        'reminder' => 'datetime',
        'reminded_at' => 'datetime',
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
        return $query->pending()
            ->where('reminder', '<=', Carbon::now());
    }

    public function scopeVisible($query)
    {
        $user = Auth::user();

        return $query->when(!$user->isSuperior(), fn ($query) => $query
            ->where(fn ($query) => $query->whereCreatedBy($user->id)
                ->orWhere('allocated_to', $user->id)));
    }

    public function scopePending($query)
    {
        return $query->whereCompleted(false);
    }

    public function scopeCompleted($query)
    {
        return $query->whereCompleted(true);
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
        $this->allocatedTo->notify((new TaskNotification($this))
            ->onQueue('notifications'));

        $this->update(['reminded_at' => Carbon::now()]);
    }

    public function overdue(): bool
    {
        return !$this->completed
            && $this->reminder?->lessThan(Carbon::now());
    }
}
