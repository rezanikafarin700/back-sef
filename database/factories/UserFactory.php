<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ybazli\Faker\Facades\Faker;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'name' => $this->faker->name(),
            'name' => Faker::firstName(),
            // 'mobile' => $this->faker->unique()->phoneNumber(),
            'mobile' => Faker::mobile(),
            'type' => $this->faker->randomElement(['USER', 'ADMIN']),
            // 'city' => $this->faker->city(),
            'city' => Faker::city(),
            'address' => Faker::address(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' =>  bcrypt('1234567'),
            'remember_token' => Str::random(10),
            'api_token' => Str::random(100)

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
