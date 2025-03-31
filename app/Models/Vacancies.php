<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancies extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function recruitment(){
        return $this->belongsTo(Recruitment::class,'Recruitmentid','id');
    }
    public function jobApplications()
    {
//        return $this->hasMany(JobApplication::class);
        return $this->hasMany(JobApplication::class, 'vacancyid', 'id');

    }
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'vacancyid', 'id');
    }

}
