<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = new User;
        $users->truncate();
        $users->create([
            'name' => $faker->name(),
            'mobile' => $faker->unique()->phoneNumber(),
            'type' => $faker->randomElement(['USER' ,'ADMIN']),
            'city' => $faker->city(),
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' =>  bcrypt('123456'),
            'remember_token' => Str::random(10),

        ]);
    }
}
