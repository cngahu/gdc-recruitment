<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerDoc extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function document(){
        return $this->belongsTo(ApplicantDocs::class,'document_id','id');
    }
}
