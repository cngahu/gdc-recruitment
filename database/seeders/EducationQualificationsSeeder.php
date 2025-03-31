<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class EducationQualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Get all users with the role "applicant"
        $applicants = DB::table('users')
            ->where('role', 'applicant')
            ->get();

        // Get data from related tables
        $academicLevels = DB::table('academic_levels')->pluck('id')->toArray();
        $courseCategories = DB::table('course_categories')->pluck('id')->toArray();
        $grades = DB::table('grades')->pluck('id')->toArray();

        foreach ($applicants as $applicant) {
            // Number of qualifications to create for each user (3-4 random records)
            $numberOfQualifications = rand(3, 4);

            $records = [];

            for ($i = 0; $i < $numberOfQualifications; $i++) {
                // Random dates
                $entryDate = Carbon::create(2025, 1, rand(1, 7));
                $exitDate = $entryDate->copy()->addYears(rand(1, 5));

                // Create a unique record
                $records[] = [
                    'userid' => $applicant->id,
                    'academiclevel' => $academicLevels[array_rand($academicLevels)],
                    'exitDate' => $exitDate->format('Y-m-d'),
                    'institutionName' => $faker->company . ' University',
                    'course_category' => $courseCategories[array_rand($courseCategories)],
                    'grade' => $grades[array_rand($grades)],
                    'certNo' => 'CERT-' . strtoupper($faker->unique()->regexify('[A-Z]{3}-[0-9]{4}')),
                    'certificate' => 'upload/educationqual/EQ-' . rand(1, 100) . '.pdf',
                    'entryDate' => $entryDate->format('Y-m-d'),
                    'created_at' => $entryDate->format('Y-m-d H:i:s'),
                    'updated_at' => now(),
                ];
            }

            // Insert records, avoiding duplicates
            DB::table('education_qualifications')->insertOrIgnore($records);
        }
    }
}
