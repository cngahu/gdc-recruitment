<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class ProfessionalMembershipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Fetch users with no_membership = 1
        $usersWithMembership = DB::table('users')
            ->where('no_membership', 1)
            ->get();

        foreach ($usersWithMembership as $user) {
            // Generate a random active status (true or false)
            $isActive = $faker->boolean();

            // Generate a random professional body
            $proffBody = $faker->company . ' Professional Body';

            // Create the record
            $record = [
                'userid' => $user->id,
                'proffBody' => $proffBody,
                'memberNumber' => 'PM-' . rand(100, 999),
                'memberCertificate' => 'upload/proffmemb/PM-' . rand(1, 9) . '.pdf',
                'created_at' => Carbon::create(2025, 1, rand(1, 7))->format('Y-m-d H:i:s'),
                'active' => $isActive,
            ];

            // Insert record for the current user
            DB::table('proffessional_memberships')->insert($record);
        }
    }
}
