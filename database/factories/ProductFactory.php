<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' =>$this->faker->name(),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(1000,10000),
            'discount' => $this->faker->numberBetween(1,100),
        ];
    }
}
