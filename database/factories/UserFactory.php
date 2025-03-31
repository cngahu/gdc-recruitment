<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        return [
//            'name' => fake()->name(),
//            'email' => fake()->unique()->safeEmail(),
//            'email_verified_at' => now(),
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//            'remember_token' => Str::random(10),
//        ];

        $dob = $this->faker->dateTimeBetween('-43 years', '-20 years')->format('Y-m-d');
        $age = now()->diff(date_create($dob))->y;

        return [
            'first_name' => $this->faker->firstName,
            'other_name' => $this->faker->lastName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'password' => Hash::make('password'), // Default password
            'phone' => $this->faker->regexify('07[0-9]{8}'), // 10-digit phone starting with 07
            'role' => 'applicant',
            'title' => $this->faker->randomElement(DB::table('designations')->pluck('id')->toArray()),
            'dob' => $dob,
            'age' => $age,
            'idnumber' => $this->faker->numberBetween(100000, 99999999),
            'gender' => $this->faker->randomElement([1, 2]),
            'nationality' => 115,
            'ethnicity' => $this->faker->randomElement(DB::table('ethnicities')->pluck('id')->toArray()),
            'county' => $this->faker->randomElement(DB::table('home_counties')->pluck('id')->toArray()),
            'constituency' => $this->faker->randomElement(DB::table('constituencies')->pluck('id')->toArray()),
            'postal_address' => $this->faker->numberBetween(100, 99999),
            'city' => $this->faker->city,
            'disability' => $this->faker->randomElement(['Yes', 'No']),
            'disabilitydescription' => function (array $data) {
                return $data['disability'] === 'Yes' ? $this->faker->sentence : null;
            },
            'no_certifications' => $this->faker->randomElement([0, 1]),
            'no_experience' => $this->faker->randomElement([0, 1]),
            'years_of_experience' => function (array $data) {
                return $data['no_experience'] === 1 ? $this->faker->numberBetween(1, 20) : null;
            },
            'leadership' => $this->faker->randomElement([0, 1]),
            'level' => 8,
            'highest_academic_level' => $this->faker->randomElement(DB::table('academic_levels')->pluck('id')->toArray()),
            'highest_weight' => function (array $data) {
                return DB::table('academic_levels')->where('id', $data['highest_academic_level'])->value('weight');
            },
            'created_at' => $this->faker->dateTimeBetween('2024-01-01', '2024-01-08'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
