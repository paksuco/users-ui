<?php

namespace Paksuco\UsersUI\Traits;

use Illuminate\Support\Facades\Auth;
use Paksuco\UsersUI\Models\PointDefinition;
use Paksuco\UsersUI\Models\UserPoint;

/**
 * User triggers event
 * Event is saved to logs (User Events) table
 * Point requirement is calculated from the (Event Points) table
 * (Point Definitions) are checked, if the user has the right to own it
 * Point is saved to (User Points) table.
 */
trait HasPointRewards
{
    public function givePoint(PointDefinition $point, $sourceModel = null, $sourceModelId = null)
    {
        if ($point->earn_count > 0) {
            $previouslyGainedPoints = $this->pointsOf($point)->count();
            if ($previouslyGainedPoints >= $point->earn_count) {
                return false;
            }
        }

        $this->insertPoint($point, $sourceModel, $sourceModelId);

        return true;
    }

    private function insertPoint(PointDefinition $point, $sourceModel, $sourceModelId)
    {
        $userPoint = new UserPoint();
        $userPoint->point_id = $point->id;
        $userPoint->user_id = Auth::id();
        $userPoint->point_source_model = $sourceModel;
        $userPoint->point_source_id = $sourceModelId;
        $userPoint->point_effect = $point->points;
        $userPoint->save();
    }

    public function pointHistory()
    {
        return $this->hasMany(UserPoint::class, "user_id")->with("definition");
    }

    public function pointsOf(PointDefinition $def)
    {
        return $this->pointHistory()->where("point_id", "=", $def->id);
    }

    public function total()
    {
        return $this->pointHistory()->sum("point_effect");
    }
}
