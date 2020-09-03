<?php

namespace Paksuco\UsersUI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BanReason extends Model
{
    use SoftDeletes;

    protected $table = "ban_reasons";

    public function bans()
    {
        return $this->hasMany(BanStatus::class, "ban_reason_id");
    }

    public function users()
    {
        return $this->hasManyThrough(\App\User::class, BanStatus::class, "ban_reason_id", "user_id", "id", "id");
    }
}
