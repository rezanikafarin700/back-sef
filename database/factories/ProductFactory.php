<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ybazli\Faker\Facades\Faker;

// use Ybazli\Faker\Facades\Faker;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomNumber(1,10),
            'title' =>$this->faker->name(),
            'title' => Faker::word(),
            'price' => $this->faker->numberBetween(1000,10000),
            // 'price' => Faker::price(),
            'discount' => $this->faker->numberBetween(1,100),
            'shipping_cost' => $this->faker->numberBetween(1000,10000),
            // 'shipping_cost' => Faker::price(),
            // 'description' => $this->faker->text(),
            'description' => Faker::sentence()
        ];
    }
}
