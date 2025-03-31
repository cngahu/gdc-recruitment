<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempjobapplication extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function vacancy(){
        return $this->belongsTo(Vacancies::class,'vacancyid','id');
    }
}
