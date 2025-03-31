<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class ExperiencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Fetch users with no_experience = 1
        $usersWithExperience = DB::table('users')
            ->where('no_experience', 1)
            ->whereNotNull('years_of_experience')
            ->get();

        foreach ($usersWithExperience as $user) {
            $yearsOfExperience = $user->years_of_experience; // Total years
            $records = [];

            // Determine the number of work experiences (at least 1)
            $numOfExperiences = rand(1, 3);

            // Calculate the years allocated per experience
            $allocatedYears = round($yearsOfExperience / $numOfExperiences);

            $startDate = Carbon::now()->subYears($yearsOfExperience);

            for ($i = 0; $i < $numOfExperiences; $i++) {
                $endDate = $startDate->copy()->addYears($allocatedYears)->subDays(rand(1, 30));

                // Determine isCurrent and related fields
                $isCurrent = $i === $numOfExperiences - 1 && rand(0, 1) === 1;
                $exitDate = $isCurrent ? null : $endDate->format('Y-m-d');
                $exitReasons = $isCurrent ? null : $faker->sentence;

                // Create the record
                $records[] = [
                    'userid' => $user->id,
                    'company' => $faker->company,
                    'jobTitle' => $faker->jobTitle,
                    'duties' => $faker->randomElement([
                        '<p>1. Provide guidance on board governance.<br>2. Coordinate legal advisory services.</p>',
                        '<p>1. Lead litigation processes.<br>2. Review contractual agreements and MOUs.</p>',
                        '<p>1. Advise on legal compliance.<br>2. Oversee performance management.</p>',
                    ]),
                    'startDate' => $startDate->format('Y-m-d'),
                    'isCurrent' => $isCurrent,
                    'exitDate' => $exitDate,
                    'exitReasons' => $exitReasons,
                    'created_at' => Carbon::create(2025, 1, rand(1, 7))->format('Y-m-d H:i:s'),
                    'updated_at' => now(),
                ];

                // Update startDate for the next record
                $startDate = $endDate;
            }

            // Insert records for the current user
            DB::table('experiences')->insertOrIgnore($records);
    }
    }
}
