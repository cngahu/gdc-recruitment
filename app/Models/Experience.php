<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Experience extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();



        static::created(function($model){
            $model->updateYearsOfExperience();
        });

        static::updated(function($model){
            $model->updateYearsOfExperience();
        });

        static::deleting(function($model){
            $model->updateYearsOfExperience();
        });

        static::deleted(function($model){
            $model->updateYearsOfExperience();
        });
    }

    public function UpdateYearsOfExperience(){



//        $res=DB::select('
//            SELECT sum(
//            floor(datediff( ifnull(exitDate,now()) ,startDate )/365 ))no_year  FROM `experiences`
//            where userid=?
//
//        ',[$this->userid]);
//
//        $user=User::findOrFail($this->userid);
//        $user->years_of_experience=$res;
//        $user->save();

        $res = DB::selectOne('
            SELECT sum(
            floor(datediff( ifnull(exitDate, now()) ,startDate )/365 )) AS no_year FROM `experiences`
            WHERE userid = ?
        ', [$this->userid]);

        $user = User::findOrFail($this->userid);
        $user->years_of_experience = $res->no_year;
        $user->save();
    }
}
