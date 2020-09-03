<?php

namespace Paksuco\UsersUI\Models;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    protected $table = "user_points";

    public function definition()
    {
        return $this->hasOne(PointDefinition::class, "point_id");
    }

    public function user()
    {
        return $this->hasOne(\App\User::class, "user_id");
    }
}
