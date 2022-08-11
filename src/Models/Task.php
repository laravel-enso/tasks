<?php

namespace LaravelEnso\Tasks\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Tables\Traits\TableCache;
use LaravelEnso\Tasks\Enums\Statuses;
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

    protected $dates = ['reminder', 'reminded_at', 'from', 'to'];

    protected $casts = [];

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
        $superiorUser = $user->isAdmin() || $user->isSupervisor();

        return $query->when(!$superiorUser, fn ($query) => $query
            ->where(fn ($query) => $query->whereCreatedBy($user->id)
                ->orWhere('allocated_to', $user->id)));
    }

    public function scopePending($query)
    {
        return $query->whereStatus(Statuses::InProgress);
    }

    public function scopeCompleted($query)
    {
        return $query->whereStatus(Statuses::Finished);
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
        return $this->status != Statuses::Finished
            && $this->reminder?->lessThan(Carbon::now());
    }

    public function checklistItems()
    {
        return $this->hasMany(ChecklistItem::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function updateStatus()
    {
        $completedItems = $this->checklistItems()->completed()->count();

        $totalItems = $this->checklistItems()->count();

        $status = match ($completedItems) {
            $totalItems  => Statuses::Finished,
            0       => Statuses::New,
            default => Statuses::InProgress,
        };

        $this->update(['status' => $status]);
    }
}
