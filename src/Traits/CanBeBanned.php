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

    public function removeBan()
    {
        $bans = $this->effectiveBans();
        foreach ($bans as $ban) {
            $ban->deleted_by = Auth::id();
            $ban->delete();
        }
    }

    public function effectiveBans()
    {
        return $this->banHistory()
            ->where("ban_start", "<=", Carbon::now())
            ->where("ban_end", ">=", Carbon::now())
            ->get();
    }

    public function isBanned()
    {
        return $this->effectiveBans()->count() > 0;
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
