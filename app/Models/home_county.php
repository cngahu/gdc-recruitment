<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class home_county extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'county', 'id');
    }


//    public function jobApplications()
//    {
//        // Retrieve job applications for users belonging to this county
//        $userIds = $this->users()->pluck('id');
//        return JobApplication::whereIn('userid', $userIds)->get();
//    }

    public function jobApplications1()
    {
        // Retrieve users belonging to this county
        $users = $this->users()->get();

        // Pluck user IDs
        $userIds = $users->pluck('id')->toArray();

        // Retrieve job applications for users belonging to this county
        return JobApplication::whereIn('userid', $userIds)->get();
    }
    public function jobApplications()
    {
        // Retrieve job applications for users belonging to this county
        $jobApplications = DB::table('job_applications')
            ->whereIn('userid', function ($query) {
                $query->select('id')
                    ->from('users')
                    ->where('county', $this->id);
            })
            ->get();

        return $jobApplications;
    }





}
