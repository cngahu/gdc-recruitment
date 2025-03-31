<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UpdateCourseNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Fetch all rows where courseName is empty or null
        $emptyCourses = DB::table('education_qualifications')
            ->whereNull('courseName')
            ->orWhere('courseName', '')
            ->get();

        foreach ($emptyCourses as $qualification) {
            DB::table('education_qualifications')
                ->where('id', $qualification->id)
                ->update([
                    'courseName' => $faker->words(3, true), // Generate a random course name, e.g., "Advanced Programming Techniques"
                    'updated_at' => now(), // Update the timestamp
                ]);
        }

    }
}
