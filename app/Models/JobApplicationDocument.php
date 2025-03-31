<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationDocument extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function vacancy(){
        return $this->belongsTo(Vacancies::class,'vacancyid','id');
    }
    public function document(){
        return $this->belongsTo(ApplicantDocs::class,'documentid','id');
    }
}
