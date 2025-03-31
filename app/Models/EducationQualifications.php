<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EducationQualifications extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assign_academiclevel(){
        return $this->belongsTo(AcademicLevels::class,'academiclevel','id');
    }
    public function assign_grade(){
        return $this->belongsTo(Grades::class,'grade','id');
    }

    public function assign_category(){
        return $this->belongsTo(CourseCategory::class,'course_category','id');
    }
    public static function boot()
    {
        parent::boot();



        self::created(function($model){
            // ... code here
            $model->UpdateHighestQualification();
        });



        self::updated(function($model){
            // ... code here
            $model->UpdateHighestQualification();
        });

        self::deleting(function($model){
            // ... code here
            $model->UpdateHighestQualification();
        });

        self::deleted(function($model){
            // ... code here
            $model->UpdateHighestQualification();
        });
    }

    public function UpdateHighestQualification(){

        $res=DB::select('
         SELECT max(al.Weight )as weight ,al.id FROM `education_qualifications` q
        join users u on q.userid=u.id
            JOIN academic_levels al on q.academiclevel=al.id
            WHERE u.id=?;
        ',[$this->userid]);

   $weightid=AcademicLevels::where('Weight',$res[0]->weight)->value('id');
     $user=User::findOrFail($this->userid);
     $user->highest_academic_level=$weightid;
        $user->highest_weight=$res[0]->weight;
        $user->save();
    }

}
