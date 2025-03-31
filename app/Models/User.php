<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,  HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    public function ccounty(){
        return $this->belongsTo(home_county::class,'county','id');
    }
    public function county(){
        return $this->belongsTo(home_county::class,'county','id');
    }
    public function cgender(){
        return $this->belongsTo(gender::class,'gender','id');
    }
    public function ctitle(){
        return $this->belongsTo(Designations::class,'title','id');
    }
    public function assign_vacancy(){
        return $this->belongsTo(Vacancies::class,'vacancy_id','id');
    }
    public function eduprofile(){
        return $this->belongsTo(AcademicLevels::class,'highest_academic_level','id');
    }
    public function ethnicity1(){
        return $this->belongsTo(ethnicity::class,'ethnicity','id');
    }

    public function homeCounty()
    {
        return $this->belongsTo(home_county::class, 'county'); // 'county' is the foreign key in the users table
    }
    public function ethnicityname() {
        return $this->belongsTo(ethnicity::class, 'ethnicity','id');
    }



    // Define the relationship for education qualifications
    public function educationQualifications()
    {
        return $this->hasMany(EducationQualifications::class, 'userid');
    }

    // Define the relationship for professional qualifications
    public function professionalQualifications()
    {
        return $this->hasMany(ProffessionalQual::class, 'userid');
    }

    // Define the relationship for professional memberships
    public function professionalMemberships()
    {
        return $this->hasMany(ProffessionalMembership::class, 'userid');
    }

    // Define the relationship for leadership courses
    public function leadershipCourses()
    {
        return $this->hasMany(LeadershipCourse::class, 'user_id');
    }

    // Define the relationship for work experiences
    public function experiences()
    {
        return $this->hasMany(Experience::class, 'userid');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function booted()
    {
        parent::booted();



        self::created(function($model){
            // ... code here

        });



        self::updated(function($model){
            // ... code here
            $model->UpdateYearsOfExperience();
        });

        self::deleting(function($model){
            // ... code here
            $model->UpdateYearsOfExperience();
        });

        self::deleted(function($model){
            // ... code here
            $model->UpdateYearsOfExperience();
        });
    }

    public function UpdateYearsOfExperience(){


        $res=DB::update('
      update users set age=floor(datediff( now() ,dob )/365) where id=?

        ',[$this->id]);


    }

}
