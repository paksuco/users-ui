<?php

namespace Paksuco\UsersUI\Traits;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Paksuco\UsersUI\Models\BanStatus;

trait CanBeBanned
{
    public function banHistory()
    {
        return $this->hasMany(BanStatus::class, "user_id");
    }

    public function ban($reason, Carbon $until = null)
    {
        $banStatus = new BanStatus();
        $banStatus->ban_start = Carbon::now();
        $banStatus->ban_end = $until;
        $banStatus->reason = $reason;
        $banStatus->banned_by = Auth::id();
        $banStatus->save();
    }

    public function isBanned()
    {
        return $this->whereHas('banHistory', function (Builder $q) {
            $q->inEffect();
        })->count() > 0;
    }

    public function scopeOnlyBanned(Builder $query)
    {
        return $query->whereHas('banHistory', function (Builder $q) {
            $q->inEffect();
        });
    }

    public function scopeNotBanned(Builder $query)
    {
        return $query->whereDoesntHave('banHistory', function (Builder $q) {
            $q->inEffect();
        });
    }
}
