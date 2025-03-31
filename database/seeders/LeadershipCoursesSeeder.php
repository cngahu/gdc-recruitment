<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class LeadershipCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Fetch users with leadership = 1
        $usersWithLeadership = DB::table('users')
            ->where('leadership', 1)
            ->get();

        foreach ($usersWithLeadership as $user) {
            // Generate a random number of courses (1 or 2)
            $numOfCourses = rand(1, 2);

            $records = [];

            for ($i = 0; $i < $numOfCourses; $i++) {
                // Generate dates
                $entryDate = Carbon::create(2025, 1, rand(1, 7))->format('Y-m-d');
                $exitDate = Carbon::createFromFormat('Y-m-d', $entryDate)->addMonths(rand(6, 36))->format('Y-m-d');
                $createdAt = Carbon::create(2025, 1, rand(1, 7))->format('Y-m-d H:i:s');

                // Create the record
                $records[] = [
                    'user_id' => $user->id,
                    'institutionName' => $faker->company . ' Leadership Institute',
                    'courseName' => $faker->words(rand(1, 2), true), // Limit to max 2 course names
                    'exitDate' => $exitDate,
                    'grade' => $faker->randomElement(['A+', 'A', 'B+', 'B', 'C']),
                    'certificate' => 'upload/lc/LC-' . rand(1, 9) . '.pdf',
                    'entryDate' => $entryDate,
                    'created_at' => $createdAt,
                    'updated_at' => now(),
                ];
            }

            // Insert records for the current user
            DB::table('leadership_courses')->insert($records);
        }
    }
}
