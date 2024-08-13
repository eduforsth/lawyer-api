<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LawyerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'password' => $this->faker->password(),
            'address' => $this->faker->address(),
        ];
    }
}
