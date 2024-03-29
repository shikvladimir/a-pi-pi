<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1,10),
            'title' => $this->faker->userName,
            'cost' => random_int(1,100).'.'.random_int(100,999),
        ];
    }
}
