<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ApartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'rented_price' => fake()->randomFloat(2, 500, 5000),
            'rented' => fake()->boolean(),
            'user_id' => User::factory(),
        ];
    }
}