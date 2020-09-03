<?php

namespace Paksuco\UsersUI\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BanStatus extends Model
{
    use SoftDeletes;

    protected $table = "banned_users";

    public function users()
    {
        return $this->hasMany(\App\User::class, "user_id");
    }

    public function inEffect()
    {
        return $this->ban_start <= Carbon::now() && $this->ban_end >= Carbon::now();
    }
}
