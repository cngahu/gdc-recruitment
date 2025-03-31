<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class ProfessionalQualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Fetch users with no_certifications = 1
        $usersWithCertifications = DB::table('users')
            ->where('no_certifications', 1)
            ->get();

        foreach ($usersWithCertifications as $user) {
            // Define a random number of qualifications (at least 1, max 2)
            $numOfQualifications = rand(1, 2);

            $records = [];

            for ($i = 0; $i < $numOfQualifications; $i++) {
                // Generate dates
                $entryDate = Carbon::create(2025, 1, rand(1, 7))->format('Y-m-d');
                $exitDate = Carbon::createFromFormat('Y-m-d', $entryDate)->addMonths(rand(6, 36))->format('Y-m-d');
                $createdAt = Carbon::create(2025, 1, rand(1, 7))->format('Y-m-d H:i:s');

                // Create the record
                $records[] = [
                    'userid' => $user->id,
                    'institutionName' => $faker->company . ' Institution',
                    'courseName' => $faker->words(rand(1, 2), true), // Limit to max 2 names
                    'exitDate' => $exitDate,
                    'grade' => $faker->randomElement(['A+', 'A', 'B+', 'B', 'C']),
                    'certificate' => 'upload/proffqual/PQ-' . rand(1, 9) . '.pdf',
                    'entryDate' => $entryDate,
                    'created_at' => $createdAt,
                    'updated_at' => now(),
                ];
            }

            // Insert records for the current user
            DB::table('proffessional_quals')->insert($records);
        }
    }
}
