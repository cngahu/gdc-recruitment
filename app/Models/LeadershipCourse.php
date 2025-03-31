<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipCourse extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Boot method to set up model events
    protected static function boot()
    {
        parent::boot();

        // When a leadership course is created
        static::created(function ($leadershipCourse) {
            $user = User::find($leadershipCourse->user_id);
            if ($user) {
                $user->leadership = 1;
                $user->save();
            }
        });

        // When a leadership course is deleted
        static::deleted(function ($leadershipCourse) {
            $user = User::find($leadershipCourse->user_id);
            if ($user) {
                // Check if the user still has leadership courses
                $hasOtherCourses = LeadershipCourse::where('user_id', $leadershipCourse->user_id)->exists();
                $user->leadership = $hasOtherCourses ? 1 : 0;
                $user->save();
            }
        });
    }
}
