<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Apartment;
use App\Models\User;

class ApartmentFactory extends Factory
{
    protected $model = Apartment::class; 

    public function definition(): array
    {
        return [
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'postal_code' => substr(fake()->postcode(), 0, 5),
            'rented_price' => fake()->randomFloat(2, 500, 5000),
            'rented' => fake()->boolean(),
            'user_id' => User::factory(), 
        ];
    }
}