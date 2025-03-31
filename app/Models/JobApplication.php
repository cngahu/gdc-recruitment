<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function vacancy(){
        return $this->belongsTo(Vacancies::class,'vacancyid','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'userid','id');
    }


}
