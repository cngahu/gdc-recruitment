<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $vacancyIds = [9];
        $applicants = User::where('role', 'applicant')->pluck('id')->toArray(); // Get all applicant IDs
        $applications = [];
        $dateRange = [strtotime('2025-01-01'), strtotime('2025-01-07')];

        foreach ($vacancyIds as $vacancyId) {
            $applicantsForVacancy = collect($applicants)->random(500)->all(); // Select 650 unique applicants
            foreach ($applicantsForVacancy as $userId) {
                $applications[] = [
                    'vacancyid'   => $vacancyId,
                    'userid'      => $userId,
                    'status'      => 'Applied',
                    'created_at'  => date('Y-m-d H:i:s', rand($dateRange[0], $dateRange[1])),
                    'updated_at'  => now(),
                ];
            }
        }

        // Insert records without duplicates
        DB::table('job_applications')->insertOrIgnore($applications);
    }
}
